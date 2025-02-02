import React, { useState } from 'react';
import axios from 'axios';

const Login = () => {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [error, setError] = useState('');

    const handleLogin = async (e) => {
        e.preventDefault();

        try {
            const response = await axios.post('http://localhost:8000/api/login', {
                email,
                password,
            }); 

            localStorage.setItem('token', response.data.token);
            alert('Login successful!');
        } catch (err) {
            setError('Invalid credentials');
        }
    };

    return (
        <div className="min-h-screen flex items-center justify-center bg-latte">
            <div className="bg-espresso p-8 rounded-lg shadow-lg w-full max-w-md text-latte">
                <h2 className="text-2xl font-bold mb-6 text-center">Login</h2>
                <form onSubmit={handleLogin} id="loginForm">
                    {/* Email Input */}
                    <div className="mb-4">
                        <label htmlFor="email" className="block text-sm font-medium">
                            Email
                        </label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            className="mt-1 block w-full px-3 py-2 bg-latte border border-caramel rounded-md text-espresso focus:outline-none focus:ring-caramel focus:border-caramel"
                            required
                            autoFocus
                        />
                    </div>

                    {/* Password Input */}
                    <div className="mb-6">
                        <label htmlFor="password" className="block text-sm font-medium text-gray-300">
                            Password
                        </label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            className="mt-1 block w-full px-3 py-2 bg-latte border border-caramel rounded-md text-espresso focus:outline-none focus:ring-caramel focus:border-caramel"
                            required
                        />
                    </div>

                    {/* Remember Me Checkbox */}
                    <div className="flex items-center justify-between mb-6">
                        <label htmlFor="remember_me" className="flex items-center">
                            <input
                                id="remember_me"
                                type="checkbox"
                                className="rounded bg-gray-700 border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            />
                            <span className="ml-2 text-sm text-gray-300">Remember me</span>
                        </label>
                    </div>

                    {/* Submit Button */}
                    <div className="flex justify-center">
                        <button
                            type="submit"
                            className="w-full px-4 py-2 bg-caramel text-espresso font-bold rounded-md hover:bg-latte focus:outline-none focus:ring-2 focus:ring-espresso"
                        >
                            Log in
                        </button>
                    </div>
                </form>

                {/* Error Message */}
                {error && (
                    <div className="mt-4 text-center text-red-500">
                        {error}
                    </div>
                )}

                {/* Additional Links (e.g., Forgot Password, Register) */}
                <div className="mt-6 text-center">
                    <a href="#" className="text-sm text-indigo-400 hover:text-indigo-300">
                        Forgot your password?
                    </a>
                </div>
            </div>
        </div>
    );
};

export default Login;