@props([
    'label',
    'value'
])

<tr>
    <td class="py-4 text-primary font-normal">{{ $label }}</td>
    <td class="py-4 text-right text-primary font-medium">{{ $label ==='3-Min Step Test (bpm)' ? $value : ['Poor', 'Needs Improvement', 'Fair', 'Good', 'Very Good', 'Excellent'][$value] }}</td>
</tr>