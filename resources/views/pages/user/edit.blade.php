<!-- resources/views/user/edit.blade.php -->
<form action="{{ route('user.update', $user->id) }}" method="POST"
    class=""
    onsubmit="return confirm('Are you sure you want to edit this item?');">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-espresso">Name</label>
        <input type="text" name="name" id="name"
            class="mt-1 block w-full rounded-md shadow-sm bg-latte border-espresso text-espresso focus:ring-caramel focus:border-caramel focus:bg-latte focus:text-espresso placeholder-caramel"
            required value="{{ $user->name }}">
    </div>

    <div class="mb-4">
        <label for="email" class="block text-sm font-medium text-espresso">Email</label>
        <input type="text" name="email" id="email"
            class="mt-1 block w-full rounded-md shadow-sm bg-latte border-espresso text-espresso focus:ring-caramel focus:border-caramel focus:bg-latte focus:text-espresso placeholder-caramel"
            required value="{{ $user->email }}">
    </div>

    <div class="mb-4">
        <label for="level" class="block text-sm font-medium text-espresso">Level</label>
        <select name="level" id="level"
            class="mt-1 block w-full rounded-md shadow-sm bg-latte border-espresso text-espresso focus:ring-caramel focus:border-caramel focus:bg-latte focus:text-espresso placeholder-caramel"
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
        <button type="button"
            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 dark:bg-gray-600 dark:hover:bg-gray-700 me-4"
            onclick="closeModal()">
            Cancel
        </button>

        <button type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700">
            Update
        </button>
    </div>
</form>