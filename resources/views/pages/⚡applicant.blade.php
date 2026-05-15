<?php

use Livewire\Component;
use App\Models\Applicant;
use App\Utilities;
use Livewire\Attributes\Url;

new class extends Component
{
    use Utilities;

    #[Url(as: 'id', except: '')]
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

    public function export()
    {
        if (!$this->applicant) return;

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.assessment-result', [
            'applicant' => $this->applicant
        ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "BPEd Assessment Result - {$this->applicant->fullName}.pdf");
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
        <div class="bg-white rounded-xl border border-muted/30 p-4 shadow-sm flex flex-col gap-4">
            {{-- header --}}
            <div class="flex items-center justify-between">
                {{-- title --}}
                <div class="flex gap-2 items-center">
                    <span class="text-green-600"><x-icons.bmi/></span>
                    <span class="text-primary text-md font-semibold">BMI Assessment</span>
                </div>
                {{-- result --}}
                <div>
                    @if ($this->isBMIPassed($applicant->weight, $applicant->height))
                        <x-green-tag>Passed</x-green-tag>
                    @else
                        <x-red-tag>Failed</x-red-tag>
                    @endif
                </div>
            </div>
            {{-- test details --}}
            <div class="grid grid-cols-2 gap-x-6 gap-y-3">
                {{-- height --}}
                <div class="flex flex-col">
                    <span class="text-xs text-muted font-medium tracking-wide">Height</span>
                    <span class="text-lg font-medium text-primary">{{ $applicant->height }} m</span>
                </div>
                {{-- weight --}}
                <div class="flex flex-col">
                    <span class="text-xs text-muted font-medium tracking-wide">Weight</span>
                    <span class="text-lg font-medium text-primary">{{ $applicant->weight }} kg</span>
                </div>
                {{-- BMI value --}}
                <div class="flex flex-col">
                    <span class="text-xs text-muted font-medium tracking-wide">BMI Value</span>
                    <span class="text-lg font-medium text-primary">{{ $this->getBMIValue($applicant->weight, $applicant->height) }}</span>
                </div>
                {{-- BMI Result --}}
                <div class="flex flex-col gap-1">
                    <span class="text-xs text-muted font-medium tracking-wide">Result</span>
                    <x-bmi-result result="{{ $this->getBMICategory($applicant->weight, $applicant->height) }}"/>
                </div>
            </div>
        </div>

        {{-- skills result --}}
        <div class="bg-white rounded-xl border border-muted/30 p-4 shadow-sm flex flex-col gap-4">
            {{-- header --}}
            <div class="flex items-center justify-between">
                {{-- title --}}
                <div class="flex gap-2 items-center">
                    <span class="text-green-600"><x-icons.skills/></span>
                    <span class="text-primary text-md font-semibold">Skills-Related Fitness</span>
                </div>
                {{-- result --}}
                <div>
                    @if ($applicant->skillsFitness->isPassed)
                        <x-green-tag>Passed</x-green-tag>
                    @else
                        <x-red-tag>Failed</x-red-tag>
                    @endif
                </div>
            </div>

            {{-- Data Table --}}
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-muted text-sm font-medium border-b border-muted/10">
                        <th class="pb-3 font-semibold">Test</th>
                        <th class="pb-3 text-right font-semibold">Score</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-muted/10">
                    <x-table-row label="Agility T-Test (sec)" :value="$applicant->skillsFitness->agilityTtestResult"/>
                    <x-table-row label="Standing Long Jump (cm)" :value="$applicant->skillsFitness->standingLongJumpResult"/>
                    <x-table-row label="Hexagon Agility Test (sec)" :value="$applicant->skillsFitness->hexagonAgilityResult"/>
                    <x-table-row label="40-Yard Dash (sec)" :value="$applicant->skillsFitness->fortyYardDashResult"/>
                    <x-table-row label="Stork Balance Stand (sec)" :value="$applicant->skillsFitness->storkBalanceStandResult"/>
                </tbody>
            </table>
        </div>

        {{-- health result --}}
        <div class="bg-white rounded-xl border border-muted/30 p-4 shadow-sm flex flex-col gap-4">
            {{-- header --}}
            <div class="flex items-center justify-between">
                {{-- title --}}
                <div class="flex gap-2 items-center">
                    <span class="text-green-600"><x-icons.health/></span>
                    <span class="text-primary text-md font-semibold">Health-Related Fitness</span>
                </div>
                {{-- result --}}
                <div>
                    @if ($applicant->skillsFitness->isPassed)
                        <x-green-tag>Passed</x-green-tag>
                    @else
                        <x-red-tag>Failed</x-red-tag>
                    @endif
                </div>
            </div>

            {{-- Data Table --}}
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-muted text-sm font-medium border-b border-muted/10">
                        <th class="pb-3 font-semibold">Test</th>
                        <th class="pb-3 text-right font-semibold">Score</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-muted/10">
                    <x-table-row label="Push-ups (reps)" :value="$applicant->healthFitness->pushUpsResult"/>
                    <x-table-row label="Sit and Reach (cm)" :value="$applicant->healthFitness->sitAndReachResult"/>
                    <x-table-row label="3-Min Step Test (bpm)" :value="$applicant->healthFitness->threeMinStepResult"/>
                    <x-table-row label="Plank (sec)" :value="$applicant->healthFitness->plankTestResult"/>
                </tbody>
            </table>
        </div>
        
        {{-- export button --}}
        <button wire:click="export" wire:loading.attr="disabled" class="w-full font-semibold text-white text-md rounded-lg bg-secondary py-2.5 hover:cursor-pointer flex gap-2 items-center justify-center">
            <span wire:loading.remove><x-icons.export size="size-6"/></span>
            <span wire:loading class="animate-spin">...</span>
            <span>Export Result</span>
        </button>
    @endif


</div>