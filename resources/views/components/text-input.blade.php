@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-caramel dark:focus:border-caramel focus:ring-caramel dark:focus:ring-caramel rounded-md shadow-sm']) }}>
