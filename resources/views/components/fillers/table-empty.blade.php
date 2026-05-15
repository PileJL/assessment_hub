@props(['isFiltered' => false])

<div class="flex flex-col items-center justify-center py-6 bg-white border border-dashed border-muted/50 rounded-sm shadow-sm text-muted">
    <x-icons.empty-trash/>
    <h3 class="text-lg font-medium mt-2">No applicants found</h3>
    <p class="text-xs text-muted mt-1">
        @if($isFiltered)
            No records match your current filters.
        @else
            The database seems to be empty.
        @endif
    </p>
</div>