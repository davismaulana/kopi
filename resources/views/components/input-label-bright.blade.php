@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-latte']) }}>
{{ $value ?? $slot }}
</label>