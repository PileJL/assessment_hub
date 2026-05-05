<?php

namespace App\Livewire\Forms;

use App\Utilities;
use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Applicant;
use Illuminate\Support\Facades\DB;

class ApplicantForm extends Form
{
    use Utilities;

    #[Validate('required|integer|min:0|unique:applicants,applicantID')]
    public ?int $applicantID;
    #[Validate('required|string|min:3|max:255')]
    public ?string $fullName;
    #[Validate('required|numeric|min:0.5|max:3.0')]
    public ?float $height;
    #[Validate('required|numeric|min:10|max:500')]
    public ?float $weight;

    /** Skills Fitness Results */
    #[Validate('required|numeric|min:0')]
    public ?float $agilityTtestResult;
    #[Validate('required|numeric|min:0')]
    public ?float $standingLongJumpResult;
    #[Validate('required|numeric|min:0')]
    public ?float $hexagonAgilityResult;
    #[Validate('required|numeric|min:0')]
    public ?float $fortyYardDashResult;
    #[Validate('required|numeric|min:0')]
    public ?float $storkBalanceStandResult;

    /** Health Fitness Results */
    #[Validate('required|integer|min:0')]
    public ?int $pushUpsResult;
    #[Validate('required|numeric|min:0')]
    public ?float $sitAndReachResult;
    #[Validate('required|integer|min:0')]
    public ?int $threeMinStepResult;
    #[Validate('required|numeric|min:0')]
    public ?float $plankTestResult;

    public function save()
    {
        $this->validate();

        // Pre-calculate results to determine the overall 'isPassed' status
        $bmiPassed = $this->getBMIresult($this->weight, $this->height);
        $skillsPassed = $this->getSkillsFitnessResult();
        $healthPassed = $this->getHealthFitnessResult();

        DB::transaction(function () use ($bmiPassed, $skillsPassed, $healthPassed) {
            // 1. Create the Applicant
            $applicant = Applicant::create([
                'applicantID' => $this->applicantID,
                'fullName'    => $this->fullName,
                'height'      => $this->height,
                'weight'      => $this->weight,
                // Overall pass only if all three categories pass
                'isPassed'    => ($bmiPassed && $skillsPassed && $healthPassed) ? 1 : 0,
            ]);

            // 2. Create the Skills Fitness Record
            $applicant->skillsFitness()->create([
                'isPassed'                => $skillsPassed,
                'agilityTtestResult'       => $this->agilityTtestResult,
                'standingLongJumpResult'   => $this->standingLongJumpResult,
                'hexagonAgilityResult'     => $this->hexagonAgilityResult,
                'fortyYardDashResult'      => $this->fortyYardDashResult,
                'storkBalanceStandResult'  => $this->storkBalanceStandResult,
            ]);

            // 3. Create the Health Fitness Record
            $applicant->healthFitness()->create([
                'isPassed'           => $healthPassed,
                'pushUpsResult'      => $this->pushUpsResult,
                'sitAndReachResult'  => $this->sitAndReachResult,
                'threeMinStepResult' => $this->threeMinStepResult,
                'plankTestResult'    => $this->plankTestResult,
            ]);
        });

        $this->reset();
    }

    private function getSkillsFitnessResult(): int
    {
        // Criteria for Passing (Aggregated "Average" Benchmarks):
        $checks = [
            $this->agilityTtestResult <= 11.5,      // Sub 11.5 seconds
            $this->standingLongJumpResult >= 200,   // At least 200 cm
            $this->hexagonAgilityResult <= 15.0,    // Sub 15 seconds
            $this->fortyYardDashResult <= 5.8,      // Sub 5.8 seconds
            $this->storkBalanceStandResult >= 15,   // Hold for 15+ seconds
        ];

        // Pass if they meet at least 4 out of 5 skills
        return count(array_filter($checks)) >= 4 ? 1 : 0;
    }

    private function getHealthFitnessResult(): int
    {
        // Criteria for Passing:
        $checks = [
            $this->pushUpsResult >= 20,             // 20+ reps
            $this->sitAndReachResult >= 25,         // 25+ cm
            $this->threeMinStepResult <= 100,       // Recovery heart rate below 100 bpm
            $this->plankTestResult >= 60,           // 60+ seconds
        ];

        // Pass if they meet at least 3 out of 4 health metrics
        return count(array_filter($checks)) >= 3 ? 1 : 0;
    }
}