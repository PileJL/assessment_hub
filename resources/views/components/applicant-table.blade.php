@props(['applicants' => null])

<div>
    <div class="border border-muted/50 shadow-sm w-fit min-w-full">
        <table class="w-full text-left border-collapse">
            {{-- Table Header --}}
            <thead class="bg-primary text-background">
                <tr>
                    <x-table-head class="whitespace-nowrap" style="width: 20%;">Applicant ID</x-table-head>
                    <x-table-head class="whitespace-nowrap hidden sm:table-cell" style="width: 20%;">Datetime ( GMT+8 )</x-table-head>
                    <x-table-head class="whitespace-nowrap" style="width: 40%;">Name</x-table-head>
                    <x-table-head class="w-25 whitespace-nowrap hidden sm:table-cell" style="width: 20%;">Result</x-table-head>
                </tr>
            </thead>

            {{-- Table Body --}}
            <tbody class="divide-y divide-muted/50">
                @foreach ($applicants as $applicant)
                    <tr wire:key="{{ $applicant->applicantID }}"
                        class="relative hover:bg-gray-200 transition-colors group">
                        {{-- applicant ID --}}
                        <x-table-data class="text-left" style="width: 20%;">
                            <a href="{{ route('admin-dashboard.edit', $applicant->applicantID) }}"
                                wire:navigate
                                class="font-medium text-primary after:absolute after:inset-0 cursor-default">
                                    {{ $applicant->applicantID }}
                            </a>
                        </x-table-data>
                        {{-- Datetime --}}
                        <x-table-data class="font-normal text-muted text-xs whitespace-nowrap hidden sm:table-cell text-left" style="width: 20%;">
                            {{ $applicant->timestampCreatedAt->format('M d, Y | h:i:s A') }}
                        </x-table-data>
                        {{-- applicant name --}}
                        <x-table-data class="font-normal max-w-80 truncate whitespace-nowrap text-left" style="width: 40%;" title="{{ $applicant->fullName }}">
                            {{ $applicant->fullName }}
                        </x-table-data>
                        {{-- Result --}}
                        <x-table-data class="font-normal text-xs whitespace-nowrap hidden sm:table-cell text-left" style="width: 20%;">
                            <x-result-col :isPassed="$applicant->isPassed" />
                        </x-table-data>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>