<?php

use Livewire\Component;
use App\Livewire\Forms\ApplicantForm;
use App\Models\Applicant;

new class extends Component
{
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
    <a href="{{ route('admin-dashboard') }}" wire:navigate class="flex gap-2 items-center text-primary font-medium rounded-lg hover:bg-green hover:text-white px-3 py-1 w-fit">
        <x-icons.back size="size-3.5"/>
        <span>Back</span>
    </a>

    {{-- header --}}
    <div>
        <h1 class="text-primary text-xl font-bold">Add Applicant</h1>
        <h2 class="text-muted text-sm font-normal">Input and manage applicant assessment data</h2>
    </div>

    {{-- applicant and BMI --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="text-primary font-bold text-md w-full mb-2">Applicant & BMI</div>
        
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Applicant ID" propertyName="form.applicantID" type="text" placeholder="12345" readonly />
            <x-label-input label="Full Name" propertyName="form.fullName" type="text" placeholder="Cruz Dela Juan" />
        </div>

        <hr class="text-muted/30 mt-2">

        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Height (m)" propertyName="form.height" type="text" placeholder="1.70" />
            <x-label-input label="Weight (kg)" propertyName="form.weight" type="text" placeholder="60" />
        </div>
    </div>
    
    {{-- skills-related fitness --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="text-primary font-bold text-md w-full mb-2">Skills-Related Fitness</div>
        
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Agility T-Test (sec)" propertyName="form.agilityTtestResult" type="text" placeholder="0.0" />
            <x-label-input label="Standing Long Jump (cm)" propertyName="form.standingLongJumpResult" type="text" placeholder="0.0" />
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Hexagon Agility Test (sec)" propertyName="form.hexagonAgilityResult" type="text" placeholder="0.0" />
            <x-label-input label="40-Yard Dash (sec)" propertyName="form.fortyYardDashResult" type="text" placeholder="0.0" />
        </div>
        <x-label-input label="Stork Balance Stand (sec)" propertyName="form.storkBalanceStandResult" type="text" placeholder="0.0" />
    </div>

    {{-- health-related fitness --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="text-primary font-bold text-md w-full mb-2">Health-Related Fitness</div>
        
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Push-ups (reps)" propertyName="form.pushUpsResult" type="number" placeholder="0" />
            <x-label-input label="Sit and Reach (cm)" propertyName="form.sitAndReachResult" type="text" placeholder="0.0" />
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="3-Min Step Test (bpm)" propertyName="form.threeMinStepResult" type="number" placeholder="0" />
            <x-label-input label="Plank (sec)" propertyName="form.plankTestResult" type="text" placeholder="0.0" />
        </div>
    </div>

    <button type="submit" class="w-full font-semibold text-white text-md rounded-lg bg-secondary py-2.5 hover:cursor-pointer flex gap-2 items-center justify-center">
        <span><x-icons.save size="size-6"/></span>
        <span>Update Record</span>
    </button>
</form>