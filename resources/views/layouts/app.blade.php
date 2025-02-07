<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (required for Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Axios --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-latte">
        <!-- Include the sidebar -->
        @include('components.sidebar')

        <div class="ml-64">
            <!-- Include the navigation -->
            {{-- @include('layouts.navigation', ['header' => $header ?? null]) --}}

            <!-- Page Heading -->
            {{-- @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset --}}

            <!-- Page Content -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            if (localStorage.getItem('auth_token')) {
                $.ajaxSetup({
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('auth_token')
                    }
                });
            }
            $('#logoutBtn').click(function(e) {
                e.preventDefault(); // Prevent default form submission

                // AJAX logout request
                $.ajax({
                    url: '/api/logout', // Pastikan route logout benar
                    type: 'POST',
                    data: {
                        _token:'{{ csrf_token() }}', // Kirim CSRF token
                    },
                    success: function(response) {
                        // Berhasil logout, arahkan ke halaman login
                        Swal.fire({
                            title: 'Logout Success',
                            text: 'You have successfully logged out.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function() {
                            // Redirect ke halaman login setelah logout
                            window.location.replace("{{ route('login') }}");
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle errors (Optional)
                        Swal.fire({
                            title: 'Logout Failed',
                            text: 'There was an error logging you out. Please try again.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>

</body>

</html>
