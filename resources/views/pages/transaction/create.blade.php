<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Transaction</h1>

    <div class="flex gap-8 p-6">
        <!-- Menu Section -->
        <div class="w-2/3">
            <h2 class="text-xl font-semibold mb-4">Select Items</h2>
            <div class="grid grid-cols-3 gap-4">
                @foreach ($menus as $menu)
                    <div class="bg-white shadow-md p-4 rounded-lg cursor-pointer" onclick="addToCart({{ json_encode($menu) }})">
                        <h3 class="text-lg font-semibold">{{ $menu->name }}</h3>
                        <p class="text-gray-500">Rp {{ number_format($menu->price, 2, ',', '.') }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cart Section -->
        <div class="w-1/3 bg-white shadow-md p-6 rounded-lg">
            <h2 class="text-xl font-semibold mb-4">Your Order</h2>
            <ul id="cart" class="mb-4"></ul>
            <p class="font-semibold">Total: Rp <span id="total-price">0</span></p>
            <label class="block mt-4">Payment Method:
                <select id="payment-method" class="border rounded w-full p-2 mt-1">
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Online Payment">Online Payment</option>
                </select>
            </label>
            <button class="bg-espresso text-white w-full mt-4 py-2 rounded hover:bg-caramel" onclick="checkout()">Checkout</button>
        </div>
    </div>

    <script>
        let cart = [];
        
        function addToCart(menu) {
            let quantity = prompt(`Enter quantity for ${menu.name}:`, 1);
            if (!quantity || quantity <= 0) return;

            let existing = cart.find(item => item.id === menu.id);
            if (existing) {
                existing.quantity += parseInt(quantity);
            } else {
                cart.push({ id: menu.id, name: menu.name, price: menu.price, quantity: parseInt(quantity) });
            }
            updateCart();
        }
        
        function updateCart() {
            let cartList = document.getElementById("cart");
            let totalPrice = 0;
            cartList.innerHTML = "";
            
            cart.forEach(item => {
                totalPrice += item.price * item.quantity;
                cartList.innerHTML += `<li class='flex justify-between'><span>${item.name} x${item.quantity}</span> <span>Rp ${item.price * item.quantity}</span></li>`;
            });
            document.getElementById("total-price").innerText = totalPrice.toLocaleString('id-ID');
        }
        
        function checkout() {
            if (cart.length === 0) return alert("Cart is empty!");
            let paymentMethod = document.getElementById("payment-method").value;
            fetch("/api/transaction", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    customer_name: "Guest",
                    menus: cart,
                    payment_method: paymentMethod,
                    payment_status: "unpaid"
                })
            }).then(response => response.json())
            .then(data => {
                alert("Transaction successful!");
                cart = [];
                updateCart();
            }).catch(error => console.error(error));
        }
    </script>
</x-app-layout>


{{-- <x-app-layout>
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
</x-app-layout> --}}
