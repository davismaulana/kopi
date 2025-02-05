<!-- resources/views/components/sidebar.blade.php -->
<aside class="w-64 bg-latte text-espresso h-screen fixed flex flex-col border-r border-espresso">
    <!-- Header -->
    <div class="p-4">
        <h1 class="text-2xl font-bold text-center">
            {{-- <i class="fa-regular fa-user"></i> {{ Auth::user()->name }} --}}
        </h1>
    </div>

    <!-- Navigation Links -->
    <nav class="mt-6 flex-1">
        <ul class="ml-3">
            <li
                class="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1 {{ request()->routeIs('dashboard') ? 'bg-espresso text-latte' : '' }}">
                <a href="{{ route('dashboard') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-md">
                            <i class="fas fa-tachometer-alt mr-5"></i>
                        </h1>
                        <h1 class="text-md">
                            Dashboard
                        </h1>
                    </div>
                </a>
            </li>
            @can('admin')
                <li
                    class="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1 {{ request()->routeIs('user.index') ? 'bg-espresso text-latte' : '' }}">
                    <a href="{{ route('user.index') }}" class="block">
                        <div class="grid grid-cols-5">
                            <h1 class="text-md">
                                <i class="fas fa-users mr-5"></i>
                            </h1>
                            <h1 class="text-md">
                                Employee
                            </h1>
                        </div>
                    </a>
                </li>
                <li
                    class="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1 {{ request()->routeIs('menu.index') ? 'bg-espresso text-latte' : '' }}">
                    <a href="{{ route('menu.index') }}" class="block">
                        <div class="grid grid-cols-5">
                            <h1 class="text-md">
                                <i class="fas fa-utensils mr-5"></i>
                            </h1>
                            <h1 class="text-md">
                                Menu
                            </h1>
                        </div>
                    </a>
                </li>
            @endcan
            <li
                class="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1 {{ request()->routeIs('transaction.index') ? 'bg-espresso text-latte' : '' }}">
                <a href="{{ route('transaction.index') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-md">
                            <i class="fas fa-money-bill-wave mr-5"></i>
                        </h1>
                        <h1 class="text-md">
                            Transaction
                        </h1>
                    </div>
                </a>
            </li>
            @can('admin')
                <li
                    class="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1 {{ request()->routeIs('customer.index') ? 'bg-espresso text-latte' : '' }}">
                    <a href="{{ route('customer.index') }}" class="block">
                        <div class="grid grid-cols-5">
                            <h1 class="text-md">
                                <i class="fas fa-user-friends mr-5"></i>
                            </h1>
                            <h1 class="text-md">
                                Customer
                            </h1>
                        </div>

                    </a>
                </li>
            @endcan

            <li
                class="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1 {{ request()->routeIs('payment.index') ? 'bg-espresso text-latte' : '' }}">
                <a href="{{ route('payment.index') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-md">
                            <i class="fas fa-receipt mr-5"></i>
                        </h1>
                        <h1 class="text-md">
                            Payment
                        </h1>
                    </div>
                </a>
            </li>

            <li
                class="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1 {{ request()->routeIs('profile.edit') ? 'bg-espresso text-latte' : '' }}">
                <a href="{{ route('profile.edit') }}" class="block">
                    <div class="grid grid-cols-5">
                        <h1 class="text-md">
                            <i class="fa-solid fa-gear mr-5"></i>
                        </h1>
                        <h1 class="text-md">
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
            <button type="submit" class="px-4 py-2 hover:bg-red-600 hover:text-latte rounded">
                <i class="fas fa-sign-out-alt mr-2"></i>Logout
            </button>
        </form>
    </div>
</aside>
