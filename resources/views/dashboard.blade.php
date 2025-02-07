<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Dashboard</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Customers Card -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-friends mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Customers</p>
                            <p class="text-3xl font-semibold" id="totalCustomers"></p>
                        </div>
                    </div>
                </div>

                <!-- Total Menus Card -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-utensils mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Menus</p>
                            <p class="text-3xl font-semibold" id="totalMenus"></p>
                        </div>
                    </div>
                </div>

                <!-- Total Payments Card -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-receipt mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Payments</p>
                            <p class="text-3xl font-semibold" id="totalPayments"></p>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Users</p>
                            <p class="text-3xl font-semibold" id="totalUsers"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphs Section -->
            <!-- Line Chart: Sales Over Time -->
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Sales Over Time</h3>
                <canvas id="salesChart"></canvas>
            </div>

            <!-- Bar Chart: Top Selling Menus -->
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg p-6 mt-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Top Selling Menus</h3>
                <canvas id="topMenusChart"></canvas>
            </div>
        </div>
    </div>

    <script>
        // document.addEventListener('DOMContentLoaded', async () => {            
        //     const token = localStorage.getItem('auth_token');
        //         const response = await fetch('http://127.0.0.1:8000/api/dashboard', {
        //             headers: {
        //                 'Authorization': Bearer + token,
        //                 'Accept': 'application/json'
        //             }
        //         });
        //         const data = await response.json();
        //     });
        $(document).ready(function() {
            var token = localStorage.getItem('auth_token');

            console.log(token);

            $.ajax({
                url: "http://127.0.0.1:8000/api/dashboard",
                type: "GET",
                headers: {
                    'Authorization': 'Bearer ' + token,
                    'Accept': 'application/json'
                },
                success: function(data){
                    $("#totalCustomers").text(data.totalCustomers);
                    $("#totalMenus").text(data.totalMenus);
                    $("#totalPayments").text(data.totalPayments);
                    $("#totalUsers").text(data.totalUsers);

                    // const salesCtx = document.getElementById('salesChart').getContext('2d')
                }
            })
        })
    </script>
</x-app-layout>
