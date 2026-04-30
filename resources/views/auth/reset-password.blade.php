@extends('layouts.app')

@section('title', 'Reset Password - ThriftMotors')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-8 transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-6 text-center dark:text-white">Set New Password</h2>

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email', $email) }}"
                    required 
                    readonly
                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white"
                >
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">New Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white"
                >
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Confirm New Password</label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    required 
                    class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold"
            >
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection
