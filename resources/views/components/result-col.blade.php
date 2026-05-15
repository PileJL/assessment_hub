@props(['isPassed' => null])

@if (is_numeric($isPassed))
    @if ($isPassed === 0)
        <flux:badge color="red">Failed</flux:badge>
    @else
        <flux:badge color="green">Passed</flux:badge>
    @endif
@else
-
@endif
