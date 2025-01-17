<!-- resources/views/components/sidebar.blade.php -->
<aside class="w-64 bg-gray-800 text-white h-screen fixed">
    <div class="p-4">
        <h2 class="text-2xl font-bold">Kopi</h2>
    </div>
    <nav class="mt-6">
        <ul>
            <li class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
            </li>
            <li class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('food.index') }}" class="block">Foods</a>
            </li>
            <li class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('drink.index') }}" class="block">Drinks</a>
            </li>
            <li class="px-4 py-2 hover:bg-gray-700">
                <a href="{{ route('profile.edit') }}" class="block">Transaction</a>
            </li>
            <li class="px-4 py-2 hover:bg-gray-700">
                <a href="#" class="block">Settings</a>
            </li>
            <li class="px-4 py-2 hover:bg-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</aside>