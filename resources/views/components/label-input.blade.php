@props([
    'label',
    'propertyName',
    'type',
    'placeholder',
])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <label class="text-primary font-medium text-sm w-full tracking-wide">{{ $label }}</label>
    <input wire:model="{{ $propertyName }}" type="{{ $type }}" placeholder="{{ $placeholder }}"
        class="mt-1 w-full border border-muted/30 bg-background rounded-lg px-3 py-2 font-normal text-primary focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50">
    {{-- Validation Error Message --}}
    @error($propertyName)
        <span class="text-red-500 text-xs mt-1 block tracking-tight">{{ $propertyName === 'form.applicantID' ? 'Applicant ID already exist.' : $message }}</span>
    @enderror
</div>