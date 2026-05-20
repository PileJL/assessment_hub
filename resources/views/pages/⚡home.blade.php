<?php

use Livewire\Component;


new class extends Component
{
    
};
?>

<div class="min-h-screen flex flex-col justify-center items-center pb-20">
    {{-- header --}}
    <div class="flex flex-col items-center justify-center text-center">
        <h1 class="text-primary font-extrabold text-3xl md:text-4xl mt-2">Fit Gate</h1>
        <h2 class="text-muted font-normal text-base md:text-lg">BPEd Assessment Results Portal</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
        {{-- applicant option --}}
        <a x-data="{ loading: false }" @click="loading = true"
            href="/applicant" wire:navigate 
            class="flex flex-col gap-3 items-center justify-center rounded-xl border-2 border-muted/30 bg-white p-8 w-full md:w-xs text-center transition-all duration-300 hover:scale-105 hover:shadow-lg hover:border-secondary cursor-pointer group">
            {{-- applicant icon --}}
            <div class="text-secondary bg-muted/10 rounded-xl w-fit px-3 py-2 group-hover:bg-secondary group-hover:text-white">
                <span x-cloak x-show="loading"><x-icons.loading size="size-10" /></span>
                <span x-show="!loading"><x-icons.clipboard size="size-10" /></span>
            </div>
            {{-- text 1 --}}
            <div class="text-primary font-semibold text-xl">
                I am an Applicant
            </div>
            {{-- text 2 --}}
            <div class="text-muted font-normal text-sm">
                Check your physical assessment scores and results
            </div>
        </a>

        {{-- admin option --}}
        <a x-data="{ loading: false }" @click="loading = true"
            href="/login" wire:navigate 
            class="flex flex-col gap-3 items-center justify-center rounded-xl border-2 border-muted/30 bg-white p-8 w-full md:w-xs text-center transition-all duration-300 hover:scale-105 hover:shadow-lg hover:border-green cursor-pointer group">
            {{-- applicant icon --}}
            <div class="text-green bg-muted/10 rounded-xl w-fit px-2.5 py-2 group-hover:bg-green group-hover:text-white">
                <span x-cloak x-show="loading"><x-icons.loading  size="size-10" /></span>
                <span x-show="!loading"><x-icons.shield-check size="size-10" /></span>
            </div>
            {{-- text 1 --}}
            <div class="text-primary font-semibold text-xl">
                I am an Administrator
            </div>
            {{-- text 2 --}}
            <div class="text-muted font-normal text-sm">
                Manage and input applicant assessment data
            </div>
        </a>
    </div>
</div>