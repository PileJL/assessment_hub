<?php

use Livewire\Component;
use App\Models\Applicant;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination;

    #[Url(as: 'id', except: '')]
    public string $applicantIdSearchText = '';
    #[Url(as: 'name', except: '',)]
    public string $applicantNameSearchText = '';

    public function clearFilters()
    {
        $this->applicantIdSearchText = '';
        $this->applicantNameSearchText = '';
        $this->resetPage();
    }

    #[Computed]
    public function applicants()
    {
        return Applicant::query()
            ->with(['skillsFitness', 'healthFitness'])
            ->byApplicantID($this->applicantIdSearchText)
            ->byApplicantName($this->applicantNameSearchText)
            ->latest('timestampCreatedAt')
            ->paginate(10)
            ->withQueryString();
    }

    public function updated($propertyName)
    {
        // If any of filter properties change, reset the pagination
        if (in_array($propertyName, ['applicantIdSearchText', 'applicantNameSearchText'])) {
            $this->resetPage();
        }
    }
};
?>

<div class="flex flex-col gap-3">
    {{-- page header --}}
    <x-page-header>Admin Dashboard</x-page-header>
    {{-- Add and Log out buttons --}}
    <div class="flex justify-between items-center">
        {{-- add applicant button --}}
        <a href="{{ route('admin-dashboard.create') }}" wire:navigate class="flex gap-1 items-center text-primary text-sm font-medium rounded-lg border border-muted/30 pl-3 pr-4 py-1 w-fit cursor-pointer shadow-sm">
            <x-icons.add size="size-4"/>
            <span>Applicant</span>
        </a>
        {{-- logout button --}}
        <a href="/logout" wire:navigate class="flex gap-1 items-center text-primary text-sm font-medium rounded-lg border border-muted/30 pl-3 pr-4 py-1 w-fit cursor-pointer shadow-sm">
            <x-icons.logout size="size-4"/>
            <span>Log out</span>
        </a>
    </div>

    {{-- filters --}}
    <div class="flex flex-col gap-2 lg:flex-row lg:gap-0 lg:justify-between mt-2">
        {{-- search filter --}}
        <x-filters.search/>
    </div>

    {{-- table --}}
    <div>
        @if ($this->applicants->count() > 0)
            <x-applicant-table :applicants="$this->applicants"/>
        @else
            <x-fillers.table-empty isFiltered="{{ $applicantIdSearchText || $applicantNameSearchText }}"/>
        @endif
    </div>

    {{-- pagination --}}
    <div>
        {{ $this->applicants->links(data: ['scrollTo' => false]) }}
    </div>

</div>