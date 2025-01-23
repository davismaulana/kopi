<!-- resources/views/user/index.blade.php -->
<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Users</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <!-- Total Admin -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-user-tie mr-2 text-blue-500 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Admin Total</p>
                            <p class="text-3xl font-semibold">{{ $countAdmin }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Cashier -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-cash-register mr-2 text-green-500 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Cashier Total</p>
                            <p class="text-3xl font-semibold">{{ $countCashier }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Customer -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-receipt mr-2 text-yellow-500 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Customer Total</p>
                            <p class="text-3xl font-semibold">{{ $countCustomer }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users mr-2 text-red-500 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">User Total</p>
                            <p class="text-3xl font-semibold">{{ $countUser }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-latte overflow-hidden shadow-md rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-4">
                        <a href="{{ route('user.create') }}"
                            class="bg-espresso text-white px-4 py-2 rounded hover:bg-caramel hover:text-espresso mb-6 inline-block">
                            Add New User
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-700 rounded-lg shadow-sm">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">
                                            Email</th>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">
                                            Level</th>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-latte bg-latte">
                                    @foreach ($users as $user)
                                        <tr class="">
                                            <td class="px-6 py-4 text-md text-espresso">{{ $user->name }}</td>
                                            <td class="px-6 py-4 text-md text-espresso">{{ $user->email }}</td>
                                            <td class="px-6 py-4 text-md text-espresso">{{ $user->level }}</td>
                                            <td class="px-6 py-4 text-sm">
                                                <div class="flex space-x-2">
                                                    <!-- Edit Button -->
                                                    <button onclick="openModal('{{ route('user.edit', $user->id) }}')"
                                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                        Edit
                                                    </button>
                                                    <!-- Delete Button -->
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST"
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

    <!-- Modal Container -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-latte p-6 rounded-lg shadow-md w-full max-w-lg">
            <div id="modal-content"></div>
        </div>
    </div>
</x-app-layout>

<!-- JavaScript for Modal Handling -->
<script>
    // Open Modal and Load Edit Form
    function openModal(url) {
        fetch(url)
            .then(response => response.text())
            .then(html => {
                document.getElementById('modal-content').innerHTML = html;
                document.getElementById('modal').classList.remove('hidden');
            });
    }

    // Close Modal
    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
    }

    // Close Modal When Clicking Outside
    // document.getElementById('modal').addEventListener('click', function (event) {
    //     if (event.target === this) {
    //         closeModal();
    //     }
    // });
</script>
