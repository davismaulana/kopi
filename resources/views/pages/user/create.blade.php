<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Create User</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <form action="{{ route('user.store') }}" method="POST" class="bg-latte p-6 rounded-lg shadow-md">
                    @csrf
                    <div class="mb-4">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input type="text" name="name" id="name" class="mt-1 block w-full" required
                            value="{{ old('name') }}" />
                        @error('name')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input type="email" name="email" id="email" class="mt-1 block w-full" required
                            value="{{ old('email') }}" />
                        @error('email')
                            <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-input-label for="level" :value="__('Level')" />
                        <select name="level" id="level"
                            class="mt-1 block w-full rounded-md border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm"
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

                        <x-primary-button>Create</x-primary-button>
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
