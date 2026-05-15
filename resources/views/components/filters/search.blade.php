<div class="flex w-full sm:w-fit py-1.5 px-3 rounded-sm items-center gap-3 bg-white border border-muted/50 text-sm text-primary shadow-sm">
    {{-- search icon --}}
    <x-icons.search></x-icons>
    {{-- task ID input --}}
    <div>
        <input 
            type="text" 
            wire:model.live.debounce="applicantIdSearchText"
            class="w-full sm:w-40 outline-none"
            placeholder="applicant ID ..."
            >
    </div>
    {{-- divider --}}
    <div class="text-muted/50 mr-3">
        |
    </div>
    {{-- acccount ID input --}}
    <div>
        <input 
            type="text" 
            wire:model.live.debounce="applicantNameSearchText"
            class="w-full sm:w-40 outline-none"
            placeholder="applicant name ..."
            >
    </div>
</div>