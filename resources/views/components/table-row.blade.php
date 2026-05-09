@props([
    'label',
    'value'
])

<tr>
    <td class="py-4 text-primary font-normal">{{ $label }}</td>
    <td class="py-4 text-right text-primary font-medium">{{ $value }}</td>
</tr>