<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Edit Customer</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="container mx-auto px-4 py-4">
                    <form action="{{ route('customer.update', $customer->id) }}" method="POST"
                        class="bg-latte p-6 rounded-lg" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Customer Name')" />
                            <x-text-input type="text" name="name" id="name"
                                class="mt-1 block w-full" required value="{{ $customer->name }}" />
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input type="text" name="address" id="address"
                                class="mt-1 block w-full" required value="{{ $customer->address }}" />
                            @error('address')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    

                        <div class="flex justify-end">
                            <a href="{{ route('customer.index') }}">
                                <button type="button"
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4">
                                    Cancel
                                </button>
                            </a>

                            <x-primary-button>Update</x-primary-button>
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
</x-app-layout>
