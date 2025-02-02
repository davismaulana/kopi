<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Payment History</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-espresso">
                    <div class="container mx-auto px-4 py-4">
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-700  rounded-lg shadow-sm">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Customer Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Menu(s) Ordered
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Payment Method</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Amount</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Payment Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Status</th>
                                        @can('admin')
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Actions</th>
                                        @endcan

                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-latte bg-latte">
                                    @foreach ($payments as $payment)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $payment->customer_name }}</td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                @foreach ($payment->menus as $menus)
                                                    <div>
                                                        {{ $menus->name }} (x{{ $menus->pivot->count }})
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $payment->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                Rp. {{ number_format($payment->amount, 2, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $payment->payment_date }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $payment->status }}
                                            </td>
                                            @can('admin')
                                                <td class="px-6 py-4 text-sm">
                                                    <div class="flex space-x-2">
                                                        <button onclick="openModal({{ $payment->id }})"
                                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">View</button>
                                                        <a href="{{ route('payment.edit', $payment->id) }}"
                                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                                        <form action="{{ route('payment.destroy', $payment->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Modal (Hidden by default) -->
                            <div id="viewModal"
                                class="fixed inset-0 bg-espresso bg-opacity-50 flex justify-center items-center hidden">
                                <div
                                    class="bg-latte text-espresso p-8 rounded-lg shadow-lg max-w-lg w-full">
                                    <h1 class="text-xl font-bold mb-4 text-center">Payment Receipt</h1>
                                    <div id="menuDetails" class="space-y-4">
                                        <!-- Receipt content will be dynamically inserted here -->
                                    </div>
                                    <button onclick="closeModal()"
                                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800 w-full">
                                        Close
                                    </button>
                                </div>
                            </div>

                            <script>
                                function openModal(paymentId) {
                                    fetch(`/payment/${paymentId}/view`)
                                        .then(response => response.json())
                                        .then(data => {

                                            const menuDetails = document.getElementById('menuDetails');

                                            let receiptContent = `
                                                <div class="text-center">
                                                    <p class="text-lg font-bold"><i class="fas fa-coffee"></i> Kopi</p>
                                                    <p class="text-sm">Jl. Example Street No. 123</p>
                                                    <p class="text-sm">Phone: 0821-4320-8119</p>
                                                </div>
                                                <div class="border-t border-b border-gray-300 py-4 my-4">
                                                    <p><strong>Customer Name:</strong> ${data.customer_name}</p>
                                                    <p><strong>Payment Date:</strong> ${data.payment_date}</p>
                                                    <p><strong>Payment Method:</strong> ${data.payment_method}</p>
                                                </div>
                                                <div class="border-b border-gray-300 py-4">
                                                    <p class="font-bold">Order Details:</p>
                                                    <table class="w-full">
                                                        <thead>
                                                            <tr>
                                                                <th class="text-left">Menu</th>
                                                                <th class="text-left">Qty</th>
                                                                <th class="text-left">Price</th>
                                                                <th class="text-left">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                            `;
                                            data.menus.forEach(menu => {
                                                receiptContent += `
                                                    <tr>
                                                        <td>${menu.name}</td>
                                                        <td>${menu.pivot.count}</td>
                                                        <td>Rp. ${menu.price.toLocaleString('id-ID')}</td>
                                                        <td>Rp. ${(menu.price * menu.pivot.count).toLocaleString('id-ID')}</td>
                                                    </tr>
                                                `;
                                            });

                                            receiptContent += `
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="border-b border-gray-300 py-4">
                                                    <p class="text-right"><strong>Total Amount:</strong> Rp. ${data.amount.toLocaleString()}</p>
                                                </div>
                                                <div class="text-center mt-4">
                                                    <p class="text-sm">Thank you for shopping with us!</p>
                                                    <p class="text-sm">Please visit us again.</p>
                                                </div>
                                            `;

                                            menuDetails.innerHTML = receiptContent;


                                            document.getElementById('viewModal').classList.remove('hidden');
                                        });
                                }

                                function closeModal() {
                                    document.getElementById('viewModal').classList.add('hidden');
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
