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

            <section class="mt-5">

                <div class="col-span-2 bg-latte rounded-lg border shadow-lg p-4 md:p-6">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-base font-bold text-espresso">Transaction Overtime</p>
                        </div>
                    </div>
                    <canvas id="area-chart" height="150"></canvas>
                </div>

            </section>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var token = localStorage.getItem('auth_token');

            console.log(token);

            $.ajax({
                url: "http://127.0.0.1:8000/api/dashboard",
                type: "GET",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content'),
                    'Accept': 'application/json'
                },
                success: function(data) {
                    $("#totalCustomers").text(data.totalCustomers);
                    $("#totalMenus").text(data.totalMenus);
                    $("#totalPayments").text(data.totalPayments);
                    $("#totalUsers").text(data.totalUsers);

                    const areaChartCtx = document.getElementById('area-chart').getContext('2d');

                    const areaChart = new Chart(areaChartCtx, {
                        type: 'line',
                        data: {
                            labels: data.salesLabels,
                            datasets: [{
                                label: 'Loans',
                                data: data.paymentCounts,
                                borderColor: "#4F46E5",
                                backgroundColor: "rgba(79, 70, 229, 0.2)",
                                borderWidth: 2,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            scales: {
                                y: {
                                    beginAtZero: true

                                }
                            }
                        }
                    });
                }
            })
        })
    </script>
</x-app-layout>
