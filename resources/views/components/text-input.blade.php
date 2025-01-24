@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm']) }}>
