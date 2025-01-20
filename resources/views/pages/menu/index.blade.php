<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Menus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <a href="{{ route('menu.create') }}"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6 inline-block">
                            Add New Menu
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-700  rounded-lg shadow-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Image</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Stock</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Category</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-gray-700">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($menus as $menu)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">
                                                @if ($menu->image)
                                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="Image"
                                                        width="50">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500 ">{{ $menu->name }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">
                                                Rp.{{ number_format($menu->price, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">{{ $menu->stock }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-white bg-gray-500">{{ $menu->category }}
                                            </td>
                                            <td class="px-6 py-4 text-sm bg-gray-500">
                                                <div class="flex space-x-2">
                                                    <button onclick="openModal({{ $menu->id }})"
                                                        class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">View</button>
                                                    <a href="{{ route('menu.edit', $menu->id) }}"
                                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                                    <form action="{{ route('menu.destroy', $menu->id) }}" method="POST"
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

                            <!-- Modal (Hidden by default) -->
                            <div id="viewModal"
                                class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center hidden">
                                <div
                                    class="bg-white dark:bg-gray-900 text-gray-900 dark:text-white p-8 rounded-lg shadow-lg max-w-lg w-full">
                                    <div class="mb-4">
                                        <img id="menuImage" alt="Menu Image"
                                            class="w-80 h-80 object-cover rounded-lg mx-auto mb-4">
                                    </div>

                                    <h1 class="text-xl font-bold mb-4">Menu Details</h1>
                                    <div id="menuDetails">
                                    </div>

                                    <button onclick="closeModal()"
                                        class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800">
                                        Close
                                    </button>
                                </div>
                            </div>

                            <script>
                                function openModal(menuId) {
                                    fetch(`/menu/${menuId}/view`)
                                        .then(response => response.json())
                                        .then(data => {

                                            const menuDetails = document.getElementById('menuDetails');
                                            const menuImage = document.getElementById('menuImage');

                                            menuDetails.innerHTML = `
                                                <p><strong>Name:</strong> ${data.name}</p>
                                                <p><strong>Price:</strong> Rp.${data.price}</p>
                                                <p><strong>Stock:</strong> ${data.stock}</p>
                                                <p><strong>Category:</strong> ${data.category}</p>
                                            `;

                                            menuImage.src = `/storage/${data.image}`;

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
