<?php

use Livewire\Component;
use App\Models\Applicant;
use App\Utilities;

new class extends Component
{
    use Utilities;

    public string $searchID = '';
    public ?Applicant $applicant = null;

    public bool $nonExistentID = false;

    public function getApplicant()
    {
        // Eager load both fitness relationships in one go
        $this->applicant = Applicant::with(['skillsFitness', 'healthFitness'])
            ->where('applicantID', $this->searchID)
            ->first();

        if (!$this->applicant) {
            $this->nonExistentID = true;
            $this->applicant = null;
        } 
        else {
            $this->nonExistentID = false;
        }
    }
};
?>

<div class="max-w-3xl mx-auto mt-4 space-y-4">
    {{-- back button --}}
    <a href="/" wire:navigate class="flex gap-2 items-center text-primary font-medium rounded-lg hover:bg-green hover:text-white px-3 py-1 w-fit">
        <x-icons.back size="size-3.5"/>
        <span>Back</span>
    </a>
    {{-- header --}}
    <div>
        <h1 class="text-2xl font-semibold text-primary">Assessment Result</h1>
        <h2 class="text-sm text-muted mt-1">Enter your Applicant ID to view your result</h2>
    </div>
    {{-- search bar --}}
    <form wire:submit.prevent="getApplicant" class="flex gap-2">
        <input wire:model="searchID" type="text" placeholder="Enter Applicant ID (e.g., 1234)"
            class="w-full border border-muted/30 bg-background rounded-lg px-3 py-2 font-normal text-primary focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50">
        
        <button type="submit" class="flex gap-1 items-center justify-between bg-secondary rounded-lg shadow-sm text-background font-medium px-3 py-1 hover:opacity-90">
            <x-icons.search/>
            <span>Search</span>
        </button>
    </form>
    {{-- applicant not found card --}}
    @if ($nonExistentID && $searchID)
        <x-red-card headerMessage="No record found for ID: {{ $searchID }}" subheaderMessage="Please check your applicant ID and try again"/>
    @endif

    {{-- applicant result --}}
    @if ($applicant)
        {{-- failed card --}}
        @if ($applicant->isPassed)
            <x-green-card headerMessage="Congratualations, You Passed!" subheaderMessage="Please see your results below"/>
        @else
            <x-red-card headerMessage="Unfortunately, You Did Not Pass" subheaderMessage="Please see your results below"/>
        @endif
        {{-- applicant name --}}
        <div class="bg-muted/10 rounded-lg flex justify-between items-center p-3">
            <div class="flex gap-2 items-center">
                <span class="text-sm text-muted">Applicant:</span>
                <span class="text-md font-primary font-medium">{{ $applicant->fullName }}</span>
            </div>
            <div class="text-muted text-sm">
                ID: {{ $applicant->applicantID }}
            </div>
        </div>
        {{-- BMI result --}}
        <div class="bg-white rounded-lg border border-muted/30 p-4 shadow-sm">
            {{-- header --}}
            <div class="flex items-center justify-between">
                {{-- title --}}
                <div>
                    <x-icons.bmi/>
                    <span>BMI Assessment</span>
                </div>
                {{-- result --}}
                <div>
                    {{ $this->getBMIresult($applicant->weight, $applicant->height) }}
                </div>
            </div>
        </div>
    @endif


</div>