<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">

                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-700  rounded-lg shadow-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Menu(s) Ordered
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Payment Method</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Amount</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Payment Date</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Status</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($payments as $payment)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">
                                                @foreach ($payment->transactions as $transaction)
                                                    <div>
                                                        {{ $transaction->menu->name }} (x{{ $transaction->count }})
                                                    </div>
                                                @endforeach
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500 ">
                                                {{ $payment->payment_method }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">
                                                Rp. {{ number_format($payment->amount, 2, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500 ">
                                                {{ $payment->payment_date }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500 ">
                                                {{ $payment->status }}
                                            </td>
                                            <td class="px-6 py-4 text-sm bg-gray-500">
                                                <div class="flex space-x-2">
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
