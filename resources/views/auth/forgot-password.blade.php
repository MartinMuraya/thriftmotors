@extends('layouts.app')

@section('title', 'Forgot Password - ThriftMotors')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-8 transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-4 text-center dark:text-white">Reset Password</h2>
        
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-6 text-center">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </p>

        @if (session('status'))
            <div class="bg-green-50 text-green-600 p-4 rounded-lg mb-6 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required 
                    autofocus
                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white"
                >
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button 
                type="submit" 
                class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold"
            >
                Email Password Reset Link
            </button>
        </form>

        <p class="text-center text-gray-600 dark:text-gray-400 text-sm mt-6">
            <a href="{{ route('login') }}" class="text-red-600 dark:text-red-400 hover:underline">Back to Login</a>
        </p>
    </div>
</div>
@endsection
