<?php

use Livewire\Component;
use App\Livewire\Forms\ApplicantForm;
use App\Models\Applicant;
use App\Utilities;

new class extends Component
{
    use Utilities;
    public ApplicantForm $form;

    public function mount(Applicant $applicant)
    {
        $this->form->setApplicant($applicant->loadMissing(['skillsFitness', 'healthFitness']));
    }

    public function update()
    {
        $this->form->update();
        // Dispatch event to the browser
        $this->dispatch('show-toast', message: 'Applicant record updated successfully!');
    }
};
?>

<form wire:submit="update" class="space-y-6 max-w-3xl mx-auto mt-4">
    {{-- back --}}
    <a x-data="{ loading: false }" @click="loading = true" href="{{ route('admin-dashboard') }}" wire:navigate class="flex gap-3 items-center text-primary font-medium rounded-lg hover:bg-green hover:text-white px-3 py-1 w-fit">
        <x-icons.back size="size-3.5"/>
        <span x-show="!loading">Back</span>
        <span x-show="loading"><x-icons.loading  size="size-5" /></span>
    </a>

    {{-- header --}}
    <div>
        <h1 class="text-primary text-xl font-bold">Update Applicant</h1>
        <h2 class="text-muted text-sm font-normal">Input and manage applicant assessment data</h2>
    </div>

    {{-- applicant and BMI --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="text-primary font-bold text-md w-full mb-2">Applicant</div>
        {{-- applicant ID and name --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Applicant ID" propertyName="form.applicantID" type="text" placeholder="12345" readonly />
            <x-label-input label="Full Name" propertyName="form.fullName" type="text" placeholder="Cruz Dela Juan" />
        </div>

        <hr class="text-muted/30 mt-2">
        {{-- BMI title and result --}}
        <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">
            <div class="text-primary font-bold text-md">BMI</div>
            <x-bmi-result result="{{ $this->getBMICategory($form->weight, $form->height) }}"/>
        </div>
        {{-- bmi inputs --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Height (m)" propertyName="form.height" type="text" placeholder="1.70" />
            <x-label-input label="Weight (kg)" propertyName="form.weight" type="text" placeholder="60" />
        </div>
    </div>
    
    {{-- skills-related fitness --}}
    <div class="flex flex-col gap-4 rounded-xl border border-muted/30 p-6 bg-white w-full">
        {{-- title --}}
        <div class="flex justify-between items-center">
            <div class="text-primary font-bold text-md w-full mb-2">Skills-Related Fitness</div>
        </div>
        {{-- stick drop & long jump input --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Stick Drop Test (cm)" propertyName="form.stickDropTestResult" type="text" placeholder="0.0" :result="$this->getStickDropTestResult($form->stickDropTestResult)" />
            <x-label-input label="Standing Long Jump (cm)" propertyName="form.standingLongJumpResult" type="text" placeholder="0.0" :result="$this->getStandingLongJumpResult($form->standingLongJumpResult)" />
        </div>
        {{-- hexagon and 40-meter --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Hexagon Agility Test (sec)" propertyName="form.hexagonAgilityResult" type="text" placeholder="0.0" :result="$this->getHexagonAgilityResult($form->hexagonAgilityResult)" />
            <x-label-input label="40-Meter Sprint (sec)" propertyName="form.fortyMeterSprinthResult" type="text" placeholder="0.0" :result="$this->get40meterSprintResult($form->fortyMeterSprinthResult)" />
        </div>
        {{-- stork balance  --}}
        <div class="flex flex-col gap-3 sm:gap-4">
            {{-- label --}}
            <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">
                <label class="text-primary font-semibold text-sm w-full tracking-wide">Stork Balance Stand Test (sec)</label>
                <x-interpretation-badge :result="$this->getStorkBalanceResult($form->leftStorkBalanceStandResult, $form->rightStorkBalanceStandResult)" />
            </div>
            {{-- inputs --}}
            <div class="flex gap-4">
                <x-label-input label="Left Foot" propertyName="form.leftStorkBalanceStandResult" type="text" placeholder="0.0" />
                <x-label-input label="Right Foot" propertyName="form.rightStorkBalanceStandResult" type="text" placeholder="0.0" />
            </div>
        </div>
        {{-- juggling --}}
        <x-label-input label="Juggling (sec)" propertyName="form.jugglingResult" type="text" placeholder="0.0" :result="$this->getJugglingResult($form->jugglingResult)" />
    </div>

    {{-- health-related fitness --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        {{-- title --}}
        <div class="flex justify-between items-center">
            <div class="text-primary font-bold text-md w-full mb-2">Health-Related Fitness</div>
        </div>
        {{-- push-up & sit and reach --}}
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Push-ups (reps)" propertyName="form.pushUpsResult" type="number" placeholder="0" :result="$this->getPushUpResult($form->pushUpsResult)" />
            <x-label-input label="Sit and Reach (cm)" propertyName="form.sitAndReachResult" type="text" placeholder="0.0" :result="$this->getSitAndReachResult($form->sitAndReachResult)" />
        </div>
        {{-- 3-min step --}}
        <div class="flex flex-col gap-3 sm:gap-4">
            {{-- label --}}
            <label class="text-primary font-semibold text-sm w-full tracking-wide">3-Min Step Test (bpm)</label>
            {{-- inputs --}}
            <div class="flex gap-4">
                <x-label-input label="Before" propertyName="form.threeMinStepBeforeResult" type="text" placeholder="0" />
                <x-label-input label="After" propertyName="form.threeMinStepAfterResult" type="text" placeholder="0" />
            </div>
        </div>
        <x-label-input label="Plank (sec)" propertyName="form.plankTestResult" type="text" placeholder="0.0" :result="$this->getPlankResult($form->plankTestResult)" />
    </div>
    {{-- remarks --}}
    <div class="flex flex-col gap-2 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="text-primary font-bold text-md w-full mb-2">Remarks</div>
        <textarea wire:model="form.remarks" class="w-full border border-muted/30 bg-background rounded-lg px-3 py-2 font-normal text-xs text-primary focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50" rows="3" placeholder="Enter remarks..."></textarea>
    </div>
    {{-- update button --}}
    <button type="submit" wire:loading.attr="disabled" class="w-full font-semibold text-white text-md rounded-lg bg-secondary py-2.5 hover:cursor-pointer flex gap-2 items-center justify-center">
        <span wire:loading.remove><x-icons.save size="size-6"/></span>
        <span wire:loading.remove>Update Record</span>
        <span wire:loading>Updating Record...</span>
    </button>
</form>