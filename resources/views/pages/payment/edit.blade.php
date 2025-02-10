<div>
    <h2 class="text-2xl font-bold mb-4 text-espresso">Update Payment</h2>

    <form id="editPaymentForm" data-payment-id="{{ $payment->id }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <x-input-label for="payment_method" :value="__('Payment Method')" />
            <select name="payment_method" id="payment_method"
                class="mt-1 block w-full rounded-md border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm"
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
            <x-input-label for="payment_status" :value="__('Payment Status')" />
            <select name="payment_status" id="payment_status"
                class="mt-1 block w-full rounded-md border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm"
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
            <button type="button" onclick="closeModal()"
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4">
                Cancel
            </button>

            <x-primary-button-nonsubmit onclick="updateForm()">Update</x-primary-button>
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