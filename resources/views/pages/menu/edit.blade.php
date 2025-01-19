<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <form action="{{ route('menu.update', $menu->id) }}" method="POST"
                            class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md"
                            onsubmit="return confirm('Are you sure you want to edit this item?');" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required value="{{ $menu->name }}">
                                @error('name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="category"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                                <select name="category" id="category"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required>
                                    @if ($menu->category == 'food')
                                        <option value="food" selected>Food</option>
                                        <option value="drink">Drink</option>
                                    @elseif ($menu->category == 'drink')
                                        <option value="food">Food</option>
                                        <option value="drink" selected>Drink</option>
                                    @else
                                        <option value="food">Food</option>
                                        <option value="drink">Drink</option>
                                    @endif
                                </select>
                            </div>


                            <div class="mb-4">
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                                <input type="number" name="price" id="price" step="0.01"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required value="{{ $menu->price }}">
                                @error('price')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="stock"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Stock</label>
                                <input type="number" name="stock" id="stock"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required value="{{ $menu->stock }}">
                                @error('stock')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image
                                    (optional)</label>
                                <input type="file" name="image" id="image"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400">
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
