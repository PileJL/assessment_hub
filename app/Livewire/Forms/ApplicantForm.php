<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Applicant;
use Illuminate\Support\Facades\DB;

class ApplicantForm extends Form
{
    #[Validate('required|integer|min:0|unique:applicants,applicantID')]
    public ?int $applicantID;
    #[Validate('required|string|min:3|max:255')]
    public ?string $fullName;
    #[Validate('required|numeric|min:0.5|max:3.0')]
    public ?float $height;
    #[Validate('required|numeric|min:10|max:500')]
    public ?float $weight;
    /**
     * Skills Fitness Results
     */
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
    /**
     * Health Fitness Results
     */
    #[Validate('required|integer|min:0')]
    public ?int $pushUpsResult;
    #[Validate('required|numeric|min:0')]
    public ?float $sitAndReachResult;
    #[Validate('required|integer|min:0')]
    public ?int $threeMinStepResult;
    #[Validate('required|numeric|min:0')]
    public ?float $plankTest;

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            // 1. Create the Applicant
            $applicant = Applicant::create([
                'applicantID' => $this->applicantID,
                'fullName'    => $this->fullName,
                'height'      => $this->height,
                'weight'      => $this->weight,
            ]);

            // 2. Create the Skills Fitness Record
            $applicant->skillsFitness()->create([
                'agilityTtestResult'       => $this->agilityTtestResult,
                'standingLongJumpResult'   => $this->standingLongJumpResult,
                'hexagonAgilityResult'     => $this->hexagonAgilityResult,
                'fortyYardDashResult'      => $this->fortyYardDashResult,
                'storkBalanceStandResult'  => $this->storkBalanceStandResult,
            ]);

            // 3. Create the Health Fitness Record
            $applicant->healthFitness()->create([
                'pushUpsResult'      => $this->pushUpsResult,
                'sitAndReachResult'  => $this->sitAndReachResult,
                'threeMinStepResult' => $this->threeMinStepResult,
                'plankTestResult'    => $this->plankTest, // Maps 'plankTest' from form to DB column
            ]);
        });

        $this->reset();
    }
}