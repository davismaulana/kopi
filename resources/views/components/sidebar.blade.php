<!-- resources/views/components/sidebar.blade.php -->
<aside class="w-64 bg-espresso text-white h-screen fixed flex flex-col">
    <!-- Header -->
    <div class="p-4">
        <h1 class="text-2xl font-bold text-center">
            {{ Auth::user()->name }}
        </h1>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-6 flex-1">
        <ul>
            <li
                class="px-4 py-4 hover:bg-latte hover:text-espresso {{ request()->routeIs('dashboard') ? 'bg-caramel text-espresso' : '' }}">
                <a href="{{ route('dashboard') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-lg">
                            <i class="fas fa-tachometer-alt mr-5"></i>
                        </h1>
                        <h1 class="text-lg">
                            Dashboard
                        </h1>
                    </div>
                </a>
            </li>
            @can('admin')
                <li
                    class="px-4 py-4 hover:bg-latte hover:text-espresso {{ request()->routeIs('user.index') ? 'bg-latte text-espresso' : '' }}">
                    <a href="{{ route('user.index') }}" class="block">
                        <div class="grid grid-cols-5">
                            <h1 class="text-lg">
                                <i class="fas fa-users mr-5"></i>
                            </h1>
                            <h1 class="text-lg">
                                User
                            </h1>
                        </div>
                    </a>
                </li>
                <li
                    class="px-4 py-4 hover:bg-latte hover:text-espresso {{ request()->routeIs('menu.index') ? 'bg-latte text-espresso' : '' }}">
                    <a href="{{ route('menu.index') }}" class="block">
                        <div class="grid grid-cols-5">
                            <h1 class="text-lg">
                                <i class="fas fa-utensils mr-5"></i>
                            </h1>
                            <h1 class="text-lg">
                                Menu
                            </h1>
                        </div>
                    </a>
                </li>
            @endcan
            <li
                class="px-4 py-4 hover:bg-latte hover:text-espresso {{ request()->routeIs('transaction.index') ? 'bg-latte text-espresso' : '' }}">
                <a href="{{ route('transaction.index') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-lg">
                            <i class="fas fa-money-bill-wave mr-5"></i>
                        </h1>
                        <h1 class="text-lg">
                            Transaction
                        </h1>
                    </div>
                </a>
            </li>
            @can('admin')
                <li
                    class="px-4 py-4 hover:bg-latte hover:text-espresso {{ request()->routeIs('customer.index') ? 'bg-latte text-espresso' : '' }}">
                    <a href="{{ route('customer.index') }}" class="block">
                        <div class="grid grid-cols-5">
                            <h1 class="text-lg">
                                <i class="fas fa-user-friends mr-5"></i>
                            </h1>
                            <h1 class="text-lg">
                                Customer
                            </h1>
                        </div>

                    </a>
                </li>
            @endcan

            <li
                class="px-4 py-4 hover:bg-latte hover:text-espresso {{ request()->routeIs('payment.index') ? 'bg-latte text-espresso' : '' }}">
                <a href="{{ route('payment.index') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-lg">
                            <i class="fas fa-receipt mr-5"></i>
                        </h1>
                        <h1 class="text-lg">
                            Payment
                        </h1>
                    </div>
                </a>
            </li>

            <li
                class="px-4 py-4 hover:bg-latte hover:text-espresso {{ request()->routeIs('setting.index') ? 'bg-latte text-espresso' : '' }}">
                <a href="{{ route('profile.edit') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-lg">
                            <i class="fa-solid fa-gear mr-5"></i>
                        </h1>
                        <h1 class="text-lg">
                            Setting
                        </h1>
                    </div>
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
