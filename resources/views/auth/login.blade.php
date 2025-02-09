<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="loginForm">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <span id="emailError" class="text-red-500 mt-2"></span>
            <div class="invalid-feedback text-gray-400 text-sm">
                Please enter a valid email address.
            </div>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <span id="passwordError" class="text-red-500 mt-2"></span>
            <div class="invalid-feedback text-gray-400 text-sm">
                Please enter your password.
            </div>

        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <h5 class="mt-5 text-transparent">-</h5>

        {{-- <h5 class="mt-5 text-center text-gray-300">Don't have an account? <a class="text-white underline"
                href="{{ route('register') }}">Register</a></h5> --}}
    </form>

    <div id="response"></div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault(); // Mencegah form submit secara default

            const email = document.getElementById('email').value;
            const password = document.querySelector('input[name="password"]').value;

            // Hapus pesan error sebelumnya
            document.getElementById('emailError').innerText = '';
            document.getElementById('passwordError').innerText = '';

            try {
                const response = await fetch('http://127.0.0.1:8000/api/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const result = await response.json();

                if (response.ok && response.status === 200) {
                    // Jika login berhasil
                    Swal.fire({
                        title: 'Log in Success',
                        text: result.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        // Redirect ke halaman login setelah logout
                        window.location.replace("{{ route('dashboard') }}");
                    });

                    // window.location.href = '{{ route('dashboard') }}';
                    // alert(result.message);
                } else {
                    Swal.fire({
                        title: 'Log in Failed',
                        text: result.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>

</x-guest-layout>
