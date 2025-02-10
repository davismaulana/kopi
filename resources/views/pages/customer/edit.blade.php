<div>
    <h2 class="text-2xl font-bold mb-4 text-espresso">Update User</h2>

    <form id="editCustomerForm" data-cust-id="{{ $customer->id }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <x-input-label for="name" :value="__('Customer Name')" />
            <x-text-input type="text" name="name" id="name" class="mt-1 block w-full" required
                value="{{ $customer->name }}" />
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input type="text" name="address" id="address" class="mt-1 block w-full" required
                value="{{ $customer->address }}" />
            @error('address')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>


        <div class="flex justify-end">
            <button type="button" onclick="closeModel()"
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
