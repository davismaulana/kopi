<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Create Menu</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="container mx-auto px-4 py-8">
                    <form action="{{ route('menu.store') }}" method="POST"
                        class="bg-latte p-6 rounded-lg" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Menu Name')" />
                            <x-text-input type="text" name="name" id="name"
                                class="mt-1 block w-full" required value="{{ old('name') }}" />
                            @error('name')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="category" :value="__('Category')" />
                            <select name="category" id="category"
                                class="mt-1 block w-full rounded-md border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm"
                                required>
                                <option value="food">Food</option>
                                <option value="drink">Drink</option>
                            </select>
                        </div>


                        <div class="mb-4">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input type="number" name="price" id="price" step="0.01" class="mt-1 block w-full"
                                required value="{{ old('price') }}" />
                            @error('price')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <x-input-label for="stock" :value="__('Stock')" />
                            <x-text-input type="number" name="stock" id="stock" class="mt-1 block w-full"
                                required value="{{ old('stock') }}" />
                            @error('stock')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="image" :value="__('Image (Opsional)')" />
                            <input type="file" name="image" id="image" accept="image/*"
                                class="mt-1 block w-full rounded-md bg-latte border-espresso focus:border-caramel focus:ring-caramel text-espresso placeholder-gray-400">
                            @error('image')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('menu.index') }}">
                                <button type="button"
                                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4">
                                    Cancel
                                </button>
                            </a>

                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Create
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
</x-app-layout>
