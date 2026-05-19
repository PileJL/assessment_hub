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

    public $applicant;

    #[Validate('required|integer|min:0|unique:applicants,applicantID')]
    public $applicantID;
    #[Validate('required|string|min:3|max:255')]
    public $fullName;
    #[Validate('required|numeric|min:0.5|max:3.0')]
    public $height;
    #[Validate('required|numeric|min:10|max:500')]
    public $weight;

    /** Skills Fitness Results */
    #[Validate('required|numeric|min:0')]
    public $stickDropTestResult;
    #[Validate('required|numeric|min:0')]
    public $standingLongJumpResult;
    #[Validate('required|numeric|min:0')]
    public $hexagonAgilityResult;
    #[Validate('required|numeric|min:0')]
    public $fortyMeterSprinthResult;
    #[Validate('required|numeric|min:0')]
    public $storkBalanceStandResult;
    #[Validate('required|numeric|min:0')]
    public $jugglingResult;

    /** Health Fitness Results */
    #[Validate('required|integer|min:0')]
    public $pushUpsResult;
    #[Validate('required|numeric|min:0')]
    public $sitAndReachResult;
    #[Validate('required|integer|min:0')]
    public $threeMinStepResult;
    #[Validate('required|numeric|min:0')]
    public $plankTestResult;

    public function setApplicant(Applicant $applicant)
    {
        $this->applicant = $applicant->loadMissing(['skillsFitness', 'healthFitness']);

        $this->applicantID = $this->applicant->applicantID;
        $this->fullName = $this->applicant->fullName;
        $this->height = $this->applicant->height;
        $this->weight = $this->applicant->weight;

        $skills = $this->applicant->skillsFitness;
        if ($skills) {
            $this->stickDropTestResult = $skills->stickDropTestResult;
            $this->standingLongJumpResult = $skills->standingLongJumpResult;
            $this->hexagonAgilityResult = $skills->hexagonAgilityResult;
            $this->fortyMeterSprinthResult = $skills->fortyMeterSprinthResult;
            $this->storkBalanceStandResult = $skills->storkBalanceStandResult;
            $this->jugglingResult = $skills->jugglingResult;
        }

        $health = $this->applicant->healthFitness;
        if ($health) {
            $this->pushUpsResult = $health->pushUpsResult;
            $this->sitAndReachResult = $health->sitAndReachResult;
            $this->threeMinStepResult = $health->threeMinStepResult;
            $this->plankTestResult = $health->plankTestResult;
        }
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {
            // 1. Create the Applicant
            $applicant = Applicant::create($this->only('applicantID', 'fullName', 'height', 'weight') + ['timestampCreatedAt' => now()]);

            // 2. Create the Skills Fitness Record
            $applicant->skillsFitness()->create($this->only('stickDropTestResult', 'standingLongJumpResult', 'hexagonAgilityResult', 'fortyMeterSprinthResult',
                'storkBalanceStandResult', 'jugglingResult'));

            // 3. Create the Health Fitness Record
            $applicant->healthFitness()->create($this->only('pushUpsResult', 'sitAndReachResult', 'threeMinStepResult', 'plankTestResult'));
        });

        $this->reset();
    }

    public function update()
    {
        $this->validate([
            'fullName' => 'required|string|min:3|max:255',
            'height' => 'required|numeric|min:0.5|max:3.0',
            'weight' => 'required|numeric|min:10|max:500',
            'stickDropTestResult' => 'required|numeric|min:0',
            'standingLongJumpResult' => 'required|numeric|min:0',
            'hexagonAgilityResult' => 'required|numeric|min:0',
            'fortyMeterSprinthResult' => 'required|numeric|min:0',
            'storkBalanceStandResult' => 'required|numeric|min:0',
            'jugglingResult' => 'required|numeric|min:0',
            'pushUpsResult' => 'required|integer|min:0',
            'sitAndReachResult' => 'required|numeric|min:0',
            'threeMinStepResult' => 'required|integer|min:0',
            'plankTestResult' => 'required|numeric|min:0',
        ]);
        DB::transaction(function () {
            // 1. Create the Applicant
            $this->applicant->update($this->only('applicantID', 'fullName', 'height', 'weight') + ['timestampCreatedAt' => now()]);

            // 2. Create the Skills Fitness Record
            $this->applicant->skillsFitness()->update($this->only('stickDropTestResult', 'standingLongJumpResult', 'hexagonAgilityResult', 'fortyMeterSprinthResult',
                'storkBalanceStandResult', 'jugglingResult'));

            // 3. Create the Health Fitness Record
            $this->applicant->healthFitness()->update($this->only('pushUpsResult', 'sitAndReachResult', 'threeMinStepResult', 'plankTestResult'));
        });
    }
}