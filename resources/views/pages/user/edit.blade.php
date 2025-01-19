<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-8">
                        <form action="{{ route('user.update', $user->id) }}" method="POST"
                            class="bg-white dark:bg-gray-700 p-6 rounded-lg shadow-md"
                            onsubmit="return confirm('Are you sure you want to edit this item?');">
                            @csrf
                            @method('PUT')
                            <div class="mb-4">
                                <label for="name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                                <input type="text" name="name" id="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required value="{{ $user->name }}">
                            </div>

                            <div class="mb-4">
                                <label for="email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                                <input type="text" name="email" id="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required value="{{ $user->email }}">
                            </div>

                            <div class="mb-4">
                                <label for="level"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Level</label>
                                <select name="level" id="level"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-100 dark:placeholder-gray-400"
                                    required>
                                    @if ($user->level == 'cashier')
                                        <option value="cashier" selected>Cashier</option>
                                        <option value="admin">Admin</option>
                                    @elseif ($user->level == 'admin')
                                        <option value="cashier">Cashier</option>
                                        <option value="admin" selected>Admin</option>
                                    @else
                                        <option value="cashier">Cashier</option>
                                        <option value="admin">Admin</option>
                                    @endif

                                </select>
                            </div>

                            <div class="flex justify-end">
                                <a href="{{ route('user.index') }}">
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
