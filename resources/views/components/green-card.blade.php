@props([
    'headerMessage',
    'subheaderMessage'
])

<div class="rounded-lg bg-green-50 border border-green-400 items-center justify-center p-6">
    <h3 class="text-md font-medium text-green-700 text-center">{{ $headerMessage }}</h3>
    <h4 class="text-sm text-gray-500 text-center">{{ $subheaderMessage }}</h4>
</div>