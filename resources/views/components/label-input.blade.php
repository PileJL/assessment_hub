@props([
    'label',
    'propertyName',
    'type',
    'placeholder',
    'readonly' => false,
    'result' => null
])

<div {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="flex flex-col gap-1 sm:flex-row sm:justify-between">
        <label class="text-primary font-semibold text-xs w-full tracking-wide">{{ $label }}</label>
        @if ($result !== null) <x-interpretation-badge :result="$result" /> @endif
    </div>
    <input wire:model="{{ $propertyName }}" type="{{ $type }}" placeholder="{{ $placeholder }}" @if($readonly) readonly @endif
        class="mt-2 w-full border border-muted/30 bg-background rounded-lg px-3 py-2 font-normal text-xs text-primary focus:border-secondary/50 focus:ring-1 focus:ring-secondary/50">
    {{-- Validation Error Message --}}
    @error($propertyName)
        <span class="text-red-500 text-xs mt-1 block tracking-tight">{{ $message }}</span>
    @enderror
</div>