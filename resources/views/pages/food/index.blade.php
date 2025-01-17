<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Foods') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <h1 class="text-3xl font-bold mb-6 dark:text-white">Foods Menu</h1>
                        <a href="{{ route('food.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6 inline-block">
                            Add New Food
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-700  rounded-lg shadow-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">Price</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">Stock</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($foods as $food)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500 ">{{ $food->name }}</td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">Rp.{{ number_format($food->price, 2) }}</td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">{{ $food->stock }}</td>
                                            <td class="px-6 py-4 text-sm bg-gray-500">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('food.edit', $food->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                                    <form action="{{ route('food.destroy', $food->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
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
