<!-- resources/views/pages/user/create.blade.php -->
<div>
    <h2 class="text-2xl font-bold mb-4 text-espresso">Update User</h2>
    <form id="editUserForm" >
        @csrf
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input type="text" name="name" id="name" class="mt-1 block w-full" value="{{ $user->name }}" required />
            <div class="text-red-500 text-sm mt-1" id="name-error"></div>
        </div>

        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input type="email" name="email" id="email" class="mt-1 block w-full" value="{{ $user->name }}" required />
            <div class="text-red-500 text-sm mt-1" id="email-error"></div>
        </div>

        <div class="mb-4">
            <x-input-label for="level" :value="__('Level')" />
            <select name="level" id="level"
                class="mt-1 block w-full rounded-md border-espresso bg-latte text-espresso focus:border-caramel focus:ring-caramel rounded-md shadow-sm" required>
                <option value="cashier" class="text-espresso">Cashier</option>
                <option value="admin" class="text-espresso">Admin</option>
            </select>
            <div class="text-red-500 text-sm mt-1" id="level-error"></div>
        </div>

        <div class="flex justify-end">
            <button type="button" onclick="closeModal()"
                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4">
                Cancel
            </button>
            <button type="button" onclick="updateForm('{{ $user->id }}')"
                class="bg-espresso text-white px-4 py-2 rounded-md hover:bg-caramel hover:text-espresso">
                Update
            </button>
        </div>
    </form>
</div>