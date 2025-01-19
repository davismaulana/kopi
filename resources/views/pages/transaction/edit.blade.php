<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Transaction') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">

                        <form action="{{ route('transaction.update', $transaction->id) }}" method="POST"
                            class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="customer_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Customer
                                    Name</label>
                                <input type="text" name="customer_name" id="customer_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required value="{{ old('customer_name', $transaction->customer->name) }}">
                            </div>
                            @error('customer_name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror

                            <div class="mb-3">
                                <label for="menus" class="form-label">Menus</label>
                                <div id="menus-container">
                                    <div class="menu-item mb-3">
                                        <select name="menus[0][id]"
                                            class="form-select mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                            required>
                                            <option value="">Select a menu</option>
                                            @foreach ($menus as $menu)
                                                <option value="{{ $menu->id }}"
                                                    {{ $menu['id'] == $transaction->menu_id ? 'selected' : '' }}>
                                                    {{ $menu->name }} -
                                                    Rp.{{ $menu->price }}</option>
                                            @endforeach
                                        </select>
                                        @error('menus[0][id]')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                        <input type="number" name="menus[0][quantity]"
                                            class="form-control mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                            placeholder="Quantity" required min="1"
                                            value="{{ old('menus[0][quantity]', $transaction->count) }}">
                                        @error('menus[0][quantity]')
                                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="total_price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Total
                                    Price</label>
                                <input type="text" name="total_price" id="total_price"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    disabled>
                            </div>

                            <div class="flex justify-end">
                                <a href="{{ route('transaction.index') }}">
                                    <button type="button"
                                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4">
                                        Cancel
                                    </button>
                                </a>

                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                    Update Transaction
                                </button>
                            </div>
                            @if ($errors->any())
                                <div class="text-red-500 text-sm mt-3">
                                    <strong>Please correct the following errors:</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menusContainer = document.getElementById('menus-container');
            const totalPriceInput = document.getElementById('total_price');

            function calculateTotalPrice() {
                let totalPrice = 0;
                const menuItems = document.querySelectorAll('.menu-item');

                menuItems.forEach(function(menuItem) {
                    const menuSelect = menuItem.querySelector('select');
                    const quantityInput = menuItem.querySelector('input[type="number"]');
                    const menuId = menuSelect.value;
                    const quantity = parseInt(quantityInput.value);

                    if (menuId && quantity > 0) {
                        // Extract price from the selected option
                        const menuPriceText = menuSelect.selectedOptions[0].text.match(/Rp\.(\d+)/);
                        const menuPrice = menuPriceText ? parseFloat(menuPriceText[1]) : 0;
                        totalPrice += menuPrice * quantity;
                    }
                });

                totalPriceInput.value = totalPrice.toFixed(2);
            }

            // Recalculate total price on quantity or menu changes
            menusContainer.addEventListener('change', calculateTotalPrice);

            // Initial calculation for pre-filled data
            calculateTotalPrice();
        });
    </script>

</x-app-layout>
