<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Menu Data</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Food -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-burger mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Food Total</p>
                            <p class="text-3xl font-semibold">{{ $countFood }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Drink -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-wine-glass mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Beverage Total</p>
                            <p class="text-3xl font-semibold">{{ $countFood }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Menu -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Menu Total</p>
                            <p class="text-3xl font-semibold">{{ $countDrink }}</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-4">
                        <a href="{{ route('menu.create') }}"
                            class="bg-espresso text-white px-4 py-2 rounded hover:bg-caramel hover:text-espresso mb-6 inline-block">
                            Add New Menu
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rounded-lg shadow-sm">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Image</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Stock</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Category</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-latte bg-latte">
                                    @foreach ($menus as $menu)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                @if ($menu->image)
                                                    <img src="{{ asset('storage/' . $menu->image) }}" alt="Image"
                                                        width="50">
                                                @else
                                                    No Image
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">{{ $menu->name }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                Rp.{{ number_format($menu->price, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-sm text-espresso">{{ $menu->stock }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">{{ $menu->category }}
                                            </td>
                                            <td class="px-6 py-4 text-sm">
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
