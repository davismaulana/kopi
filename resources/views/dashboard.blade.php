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
                <div class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-friends mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Customers</p>
                            <p class="text-3xl font-semibold">{{ $totalCustomers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Menus Card -->
                <div class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-utensils mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Menus</p>
                            <p class="text-3xl font-semibold">{{ $totalMenus }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Payments Card -->
                <div class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-receipt mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Payments</p>
                            <p class="text-3xl font-semibold">{{ $totalPayments }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Total Users</p>
                            <p class="text-3xl font-semibold">{{ $totalUsers }}</p>
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
        // Line Chart: Sales Over Time
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const gradient = salesCtx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.8)'); // Indigo
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0.2)'); // Lighter Indigo

        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Total Sales',
                    data: @json(array_values($salesData)), // Use real sales data
                    borderColor: 'rgba(99, 102, 241, 1)',
                    borderWidth: 2,
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        enabled: true,
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)', // Light gridlines
                        },
                    },
                    x: {
                        grid: {
                            color: 'rgba(200, 200, 200, 0.2)', // Light gridlines
                        },
                    },
                },
            }
        });

        // Bar Chart: Top Selling Menus
        const topMenusCtx = document.getElementById('topMenusChart').getContext('2d');
        const topMenusChart = new Chart(topMenusCtx, {
            type: 'bar',
            data: {
                labels: @json(array_keys($topMenusData)), // Menu names
                datasets: [{
                    label: 'Quantity Sold',
                    data: @json(array_values($topMenusData)), // Quantities sold
                    backgroundColor: 'rgba(0, 245, 71, 0.6)',
                    borderColor: 'rgba(0, 245, 71, 1)',
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-app-layout>
