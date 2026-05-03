@extends('layouts.app')

@section('title', 'Settings - ThriftMotors')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold dark:text-white">Account Settings</h1>
        <p class="text-gray-600 dark:text-gray-400">Manage your password and security settings.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 overflow-hidden transition-colors duration-300">
        <div class="p-8 border-b dark:border-gray-700">
            <h3 class="text-xl font-bold dark:text-white mb-2">Update Password</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">Ensure your account is using a long, random password to stay secure.</p>
        </div>

        <form action="{{ route('user.settings.password') }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PATCH')

            <div class="max-w-xl space-y-4">
                <!-- Current Password -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Current Password</label>
                    <input type="password" name="current_password" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    @error('current_password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">New Password</label>
                    <input type="password" name="password" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    @error('password')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Confirm New Password</label>
                    <input type="password" name="password_confirmation" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-8 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
