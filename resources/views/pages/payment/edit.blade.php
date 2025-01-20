<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <form action="{{ route('payment.update', $payment->id) }}" method="POST"
                            class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="payment_method"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment
                                    Method</label>
                                <select name="payment_method" id="payment_method"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required>
                                    <option value="">Select a payment method</option>
                                    <option value="Cash" {{ $payment->payment_method == 'Cash' ? 'selected' : '' }}>
                                        Cash</option>
                                    <option value="Credit Card"
                                        {{ $payment->payment_method == 'Credit Card' ? 'selected' : '' }}>Credit Card
                                    </option>
                                    <option value="Online Payment"
                                        {{ $payment->payment_method == 'Online Payment' ? 'selected' : '' }}>Online
                                        Payment</option>
                                </select>
                                @error('payment_method')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Payment Status -->
                            <div class="mb-4">
                                <label for="payment_status"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Payment
                                    Status</label>
                                <select name="payment_status" id="payment_status"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required>
                                    <option value="">Select a payment status</option>
                                    <option value="unpaid" {{ $payment->status == 'unpaid' ? 'selected' : '' }}>Unpaid
                                    </option>
                                    <option value="paid" {{ $payment->status == 'paid' ? 'selected' : '' }}>Paid
                                    </option>
                                </select>
                                @error('payment_status')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <a href="{{ route('payment.index') }}">
                                    <button type="button"
                                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4">
                                        Cancel
                                    </button>
                                </a>

                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                    Update
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
</x-app-layout>
