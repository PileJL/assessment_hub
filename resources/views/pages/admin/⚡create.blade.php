<?php

use Livewire\Component;
use App\Livewire\Forms\ApplicantForm;

new class extends Component
{
    public ApplicantForm $form;

    public function save()
    {
        $this->form->save();
        // Dispatch event to the browser
        $this->dispatch('show-toast', message: 'Applicant record saved successfully!');
    }
};
?>

<form wire:submit="save" class="space-y-6 max-w-3xl mx-auto mt-4">
    {{-- back --}}
    <a x-data="{ loading: false }" @click="loading = true" href="{{ route('admin-dashboard') }}" wire:navigate class="flex gap-3 items-center text-primary font-medium rounded-lg hover:bg-green hover:text-white px-3 py-1 w-fit">
        <x-icons.back size="size-3.5"/>
        <span x-show="!loading">Back</span>
        <span x-show="loading"><x-icons.loading  size="size-5" /></span>
    </a>

    {{-- header --}}
    <div>
        <h1 class="text-primary text-xl font-bold">Add Applicant</h1>
        <h2 class="text-muted text-sm font-normal">Input and manage applicant assessment data</h2>
    </div>

    {{-- applicant and BMI --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="text-primary font-bold text-md w-full mb-2">Applicant</div>
        
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Applicant ID" propertyName="form.applicantID" type="text" placeholder="12345" />
            <x-label-input label="Full Name" propertyName="form.fullName" type="text" placeholder="Cruz Dela Juan" />
        </div>

        <hr class="text-muted/30 mt-2">

        <div class="flex justify-between items-center">
            <div class="text-primary font-bold text-md w-full mb-2">BMI</div>
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Height (m)" propertyName="form.height" type="text" placeholder="1.70" />
            <x-label-input label="Weight (kg)" propertyName="form.weight" type="text" placeholder="60" />
        </div>
    </div>
    
    {{-- skills-related fitness --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="flex justify-between items-center">
            <div class="text-primary font-bold text-md w-full mb-2">Skills-Related Fitness</div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Stick Drop Test (cm)" propertyName="form.stickDropTestResult" type="text" placeholder="0.0" />
            <x-label-input label="Standing Long Jump (cm)" propertyName="form.standingLongJumpResult" type="text" placeholder="0.0" />
        </div>

        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Hexagon Agility Test (sec)" propertyName="form.hexagonAgilityResult" type="text" placeholder="0.0" />
            <x-label-input label="40-Meter Sprint (sec)" propertyName="form.fortyMeterSprinthResult" type="text" placeholder="0.0" />
        </div>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <x-label-input label="Left - Stork Balance Stand Test (sec)" propertyName="form.leftStorkBalanceStandResult" type="text" placeholder="0.0" />
            <x-label-input label="Right - Stork Balance Stand Test (sec)" propertyName="form.rightStorkBalanceStandResult" type="text" placeholder="0.0" />
        </div>
        <x-label-input label="Juggling (sec)" propertyName="form.jugglingResult" type="text" placeholder="0.0" />
    </div>

    {{-- health-related fitness --}}
    <div class="flex flex-col gap-3 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="flex justify-between items-center">
            <div class="text-primary font-bold text-md w-full mb-2">Health-Related Fitness</div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-2 sm:gap-4">
            <x-label-input label="Push-ups (reps)" propertyName="form.pushUpsResult" type="text" placeholder="0" />
            <x-label-input label="Sit and Reach (cm)" propertyName="form.sitAndReachResult" type="text" placeholder="0.0" />
        </div>

        <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
            <x-label-input label="3-Min Step Test Before (bpm)" propertyName="form.threeMinStepBeforeResult" type="text" placeholder="0" />
            <x-label-input label="3-Min Step Test After (bpm)" propertyName="form.threeMinStepAfterResult" type="text" placeholder="0" />
        </div>
        <x-label-input label="Plank (sec)" propertyName="form.plankTestResult" type="text" placeholder="0.0" />
    </div>

    <div class="flex flex-col gap-2 rounded-xl border border-muted/30 p-6 bg-white w-full">
        <div class="text-primary font-bold text-md w-full mb-2">Remarks</div>
        <textarea wire:model="form.remarks" class="w-full border border-muted/30 rounded-lg p-3 text-sm" rows="3" placeholder="Enter remarks..."></textarea>
    </div>

    <button type="submit" wire:loading.attr="disabled" class="w-full font-semibold text-white text-md rounded-lg bg-secondary py-2.5 hover:cursor-pointer flex gap-2 items-center justify-center">
        <span wire:loading.remove><x-icons.save size="size-6"/></span>
        <span wire:loading.remove>Save Record</span>
        <span wire:loading>Saving Record...</span>
    </button>
</form>