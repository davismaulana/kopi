@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-md text-espresso']) }}>
    {{ $value ?? $slot }}
</label>
