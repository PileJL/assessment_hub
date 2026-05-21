@props(['result'])

@php
    [$label, $bgClass] = match ((int) $result) {
        5 => ['Excellent', 'bg-emerald-600'],
        4 => ['Very Good', 'bg-green-600'],
        3 => ['Good', 'bg-teal-600'],
        2 => ['Fair', 'bg-amber-600'],
        1 => ['Needs Improvement', 'bg-orange-600'],
        default => ['Poor', 'bg-red-600'],
    };
@endphp

<div class="{{ $bgClass }} rounded-xl text-white font-semibold text-xs px-2 py-0.5 w-fit h-fit inline-flex items-center whitespace-nowrap">
    {{ $label }}
</div>