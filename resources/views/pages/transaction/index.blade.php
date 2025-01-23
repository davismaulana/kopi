<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Transaction Log</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-4">
                        <a href="{{ route('transaction.create') }}"
                            class="bg-espresso text-white px-4 py-2 rounded hover:bg-caramel hover:text-espresso mb-6 inline-block">
                            Add New Transaction
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rounded-lg shadow-sm">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Chasier Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Customer Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Menu Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Quantity</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Total Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Date</th>
                                        @can('admin')
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-latte bg-latte">
                                    @foreach ($transactions as $trans)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-white">
                                                {{ $trans->cashier->name }}</td>
                                            <td class="px-6 py-4 text-sm text-white">
                                                {{ $trans->customer->name }}</td>
                                            <td class="px-6 py-4 text-sm text-white">
                                                {{ $trans->menu->name }}</td>
                                            <td class="px-6 py-4 text-sm text-white">{{ $trans->count }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white">
                                                Rp.{{ number_format($trans->total_price, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-sm text-white">
                                                {{ $trans->created_at }}</td>

                                            @can('admin')
                                                <td class="px-6 py-4 text-sm">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('transaction.edit', $trans->id) }}"
                                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                                        <form action="{{ route('transaction.destroy', $trans->id) }}"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
