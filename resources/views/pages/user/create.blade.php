<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Create User</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <form action="{{ route('user.store') }}" method="POST"
                    class="bg-latte p-6 rounded-lg shadow-md">
                    @csrf
                    <div class="mb-4">
                        <label for="name"
                            class="block text-sm font-medium text-espresso">Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full rounded-md shadow-sm bg-latte focus:border-caramel focus:ring-caramel placeholder-gray-400 text-espresso"
                            required {{ old('name') }}>
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email"
                            class="block text-sm font-medium text-espresso">Email</label>
                        <input type="text" name="email" id="email"
                            class="mt-1 block w-full rounded-md border-espresso bg-latte shadow-sm bg-latte focus:border-caramel focus:ring-caramel text-espresso placeholder-gray-400"
                            required {{ old('email') }}>
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="level"
                            class="block text-sm font-medium text-espresso">Level</label>
                        <select name="level" id="level"
                            class="mt-1 block w-full rounded-md border-espresso bg-latte shadow-sm focus:border-caramel focus:ring-caramel text-espresso placeholder-gray-400"
                            required>
                            <option value="cashier" class="text-espresso">Cashier</option>
                            <option value="admin" class="text-espresso">Admin</option>
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
                            class="bg-blue-500 text-latte px-4 py-2 rounded-md bg-espresso hover:bg-caramel hover:text-espresso">
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
</x-app-layout>
