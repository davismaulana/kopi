<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="loginForm">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label-bright for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <span id="emailError" class="text-red-500 mt-2"></span>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label-bright for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <span id="passwordError" class="text-red-500 mt-2"></span>
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

        <h5 class="mt-5 text-center text-gray-300">Don't have an account? <a class="text-white underline"
                href="{{ route('register') }}">Register</a></h5>
    </form>

    <div id="response"></div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            fetch("http://127.0.0.1:8000/api/login", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Login response:", data); // Debugging

                    if (data.status) {
                        localStorage.setItem("auth_token", data.token); // ✅ Save token
                        console.log("Token saved:", localStorage.getItem("auth_token"));
                        window.location.href = "/dashboard"; // Redirect after login
                    } else {
                        alert("Login failed: " + data.message);
                    }
                })
                .catch(error => console.error("Login error:", error));

                console.log(localStorage.getItem('auth_token'));

            // try {
            //     const response = await fetch('http://127.0.0.1:8000/api/login', {
            //         method: 'POST',
            //         headers: {
            //             'Content-Type': 'application/json',
            //         },
            //         body: JSON.stringify({
            //             email,
            //             password
            //         })
            //     })

            //     const result = await response.json();

            //     if (response.ok) {
            //         alert(result.message);

            //         window.location.href = 'http://127.0.0.1:8000/dashboard';
            //     } else {
            //         if (result.message.includes['Email']) {
            //             document.getElementById('emailError').innerText = result.message;
            //         } else {
            //             document.getElementById('passwordError').innerText = result.message
            //         }
            //     }
            // } catch (error) {
            //     console.error('Error:', error);
            // }
        })
    </script>

</x-guest-layout>
