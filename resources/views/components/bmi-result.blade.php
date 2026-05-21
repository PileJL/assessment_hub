@props(['result'])

@php
    $bgClass = match ($result) {
        'Underweight' => 'bg-orange',
        'Normal'      => 'bg-green',
        'Overweight'  => 'bg-yellow',
        'Obese'       => 'bg-red',
        default       => 'bg-gray-500',
    };
@endphp

<div class="{{ $bgClass }} rounded-xl text-white font-semibold text-xs px-2 py-0.5 w-fit h-fit items-center whitespace-nowrap">
    {{ $result }}
</div>