<!-- resources/views/components/sidebar.blade.php -->
<aside class="w-64 bg-gray-800 text-white h-screen fixed flex flex-col">
    <!-- Header -->
    <div class="p-4">
        <h2 class="text-2xl font-bold">
            <i class="fas fa-coffee mr-2"></i>Kopi
        </h2>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-6 flex-1">
        <ul>
            @can('admin')
                <li class="px-4 py-3 hover:bg-gray-700">
                    <a href="{{ route('dashboard') }}" class="block">
                        <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                    </a>
                </li>
                <li class="px-4 py-3 hover:bg-gray-700">
                    <a href="{{ route('user.index') }}" class="block">
                        <i class="fas fa-users mr-2"></i>User
                    </a>
                </li>
                <li class="px-4 py-3 hover:bg-gray-700">
                    <a href="{{ route('menu.index') }}" class="block">
                        <i class="fas fa-utensils mr-2"></i>Menu
                    </a>
                </li>
            @endcan

            <li class="px-4 py-3 hover:bg-gray-700">
                <a href="{{ route('transaction.index') }}" class="block">
                    <i class="fas fa-receipt mr-2"></i>Transaction
                </a>
            </li>
            
            @can('admin')
                <li class="px-4 py-3 hover:bg-gray-700">
                    <a href="{{ route('customer.index') }}" class="block">
                        <i class="fas fa-user-friends mr-2"></i>Customer
                    </a>
                </li>
            @endcan

            <li class="px-4 py-3 hover:bg-gray-700">
                <a href="{{ route('payment.index') }}" class="block">
                    <i class="fas fa-user-friends mr-2"></i>Payment
                </a>
            </li>
        </ul>
    </nav>

    <!-- Logout Button -->
    <div class="p-4 mt-auto text-right">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 hover:bg-gray-700 rounded">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
        </form>
    </div>
</aside>
