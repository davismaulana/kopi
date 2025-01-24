<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Create Transaction</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="container mx-auto px-4 py-8">
                    <form action="{{ route('transaction.store') }}" method="POST" class="bg-latte p-6 rounded-lg">
                        @csrf

                        <!-- Customer Name -->
                        <div class="mb-4">
                            <x-input-label for="customer_name" :value="__('Customer Name')" />
                            <x-text-input type="text" name="customer_name" id="customer_name"
                                class="mt-1 block w-full" required value="{{ old('customer_name') }}" />
                        </div>
                        @error('customer_name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror

                        <!-- Menus -->
                        <div class="mb-3">
                            <x-input-label for="menus" :value="__('Menu')" />
                            <div id="menus-container">
                                <!-- Initial Menu Item -->
                                <div class="menu-item mb-3">
                                    <select name="menus[0][id]"
                                        class="menu-select mt-1 block w-full rounded-md border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm"
                                        required>
                                        <option value="">Select a menu</option>
                                        @foreach ($menus as $menu)
                                            @if ($menu->stock == 0)
                                                <option value="{{ $menu->id }}" data-stock="{{ $menu->stock }}"
                                                    disabled>
                                                    {{ $menu->name }} - Rp.{{ $menu->price }} - Stock:
                                                    {{ $menu->stock }}
                                                </option>
                                            @else
                                                <option value="{{ $menu->id }}" data-stock="{{ $menu->stock }}">
                                                    {{ $menu->name }} - Rp.{{ $menu->price }} - Stock:
                                                    {{ $menu->stock }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('menus[0][id]')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                    <x-text-input type="number" name="menus[0][quantity]" class="mt-2 block w-full"
                                        placeholder="Quantity" required min="1" />
                                    @error('menus[0][quantity]')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <x-primary-button-nonsubmit id="add-menu">{{ __('Add Another Menu') }} </x-primary-button>
                        </div>

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <x-input-label for="payment_method" :value="__('Payment Method')" />
                            <select name="payment_method" id="payment_method"
                                class="mt-1 block w-full rounded-md shadow-sm text-espresso border-espresso focus:border-caramel focus:ring-caramel bg-latte placeholder-gray-400"
                                required>
                                <option value="">Select a payment method</option>
                                <option value="Cash">Cash</option>
                                <option value="Credit Card">Credit Card</option>
                                <option value="Online Payment">Online Payment</option>
                            </select>
                            @error('payment_method')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Payment Status -->
                        <div class="mb-4">
                            <x-input-label for="payment_status" :value="__('Payment Status')" />
                            <select name="payment_status" id="payment_status"
                                class="mt-1 block w-full rounded-md shadow-sm text-espresso border-espresso focus:border-caramel focus:ring-caramel bg-latte placeholder-gray-400"
                                required>
                                <option value="">Select a payment status</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="paid">Paid</option>
                            </select>
                            @error('payment_status')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Total Price -->
                        <div class="mb-4">
                            <x-input-label for="total_price" :value="__('Total Price')" />
                            <x-text-input :disabled="true" type="text" name="total_price" id="total_price" class="mt-1 block w-full" />
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end">
                            <a href="{{ route('transaction.index') }}">
                                <button type="button"
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4">
                                    Cancel
                                </button>
                            </a>
                            <x-primary-button>Create Transaction</x-primary-button>
                        </div>

                        <!-- Error Messages -->
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addMenuButton = document.getElementById('add-menu');
            const menusContainer = document.getElementById('menus-container');
            const totalPriceInput = document.getElementById('total_price');
            let menuCount = 1;

            // Add another menu item
            addMenuButton.addEventListener('click', function() {
                const newMenuItem = document.createElement('div');
                newMenuItem.classList.add('menu-item', 'mb-3');
                newMenuItem.innerHTML = `
                    <select name="menus[${menuCount}][id]"
                        class="menu-select mt-1 block w-full rounded-md border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm"
                        required>
                        <option value="">Select a menu</option>
                        @foreach ($menus as $menu)
                            @if ($menu->stock == 0)
                                <option value="{{ $menu->id }}" data-stock="{{ $menu->stock }}" disabled>
                                    {{ $menu->name }} - Rp.{{ $menu->price }} - Stock:
                                    {{ $menu->stock }}
                                </option>
                            @else
                                <option value="{{ $menu->id }}" data-stock="{{ $menu->stock }}">
                                    {{ $menu->name }} - Rp.{{ $menu->price }} - Stock:
                                    {{ $menu->stock }}
                                </option>
                            @endif
                                            
                        @endforeach
                    </select>
                     @error('menus[${menuCount}][id]')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                                    <x-text-input type="number" name="menus[${menuCount}][quantity]" class="mt-2 block w-full"
                                        placeholder="Quantity" required min="1" />
                                    @error('menus[${menuCount}][quantity]')
                                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                    @enderror
                    
                `;
                menusContainer.appendChild(newMenuItem);
                menuCount++;
            });

            // Validate quantity input
            menusContainer.addEventListener('input', function(event) {
                if (event.target.matches('input[type="number"]')) {
                    const quantityInput = event.target;
                    const menuSelect = quantityInput.closest('.menu-item').querySelector('select');
                    const selectedMenu = menuSelect.selectedOptions[0];

                    if (selectedMenu && selectedMenu.dataset.stock) {
                        const stock = parseInt(selectedMenu.dataset.stock);
                        const quantity = parseInt(quantityInput.value);

                        if (quantity > stock) {
                            alert('Quantity exceeds available stock!');
                            quantityInput.value = stock; // Reset to max stock
                        }
                    }
                }
            });

            // Calculate total price when quantity or menu is changed
            menusContainer.addEventListener('change', function(event) {
                if (event.target.matches('select, input[type="number"]')) {
                    let totalPrice = 0;
                    const menuItems = document.querySelectorAll('.menu-item');

                    menuItems.forEach(function(menuItem) {
                        const menuSelect = menuItem.querySelector('select');
                        const quantityInput = menuItem.querySelector('input[type="number"]');
                        const menuId = menuSelect.value;
                        const quantity = parseInt(quantityInput.value);

                        if (menuId && quantity > 0) {
                            const menuPriceText = menuSelect.selectedOptions[0].text.match(
                                /Rp\.(\d+)/);
                            const menuPrice = menuPriceText ? parseFloat(menuPriceText[1]) : 0;
                            totalPrice += menuPrice * quantity;
                        }
                    });

                    // Update total price input
                    totalPriceInput.value = `Rp. ${totalPrice.toFixed(2)}`;
                }
            });
        });
    </script>
</x-app-layout>
