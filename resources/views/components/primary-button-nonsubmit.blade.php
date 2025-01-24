<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-espresso text-latte border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-caramel focus:bg-latte focus:bg-latte active:bg-latte focus:outline-none focus:ring-2 focus:ring-caramel focus:text-espresso focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
