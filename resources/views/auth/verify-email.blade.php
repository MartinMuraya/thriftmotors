@extends('layouts.app')

@section('title', 'Verify Email - ThriftMotors')

@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-8 transition-colors duration-300">
        <h2 class="text-2xl font-bold mb-6 text-center dark:text-white">Verify Your Email</h2>

        <p class="text-gray-600 dark:text-gray-400 mb-6 text-center">
            Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
        </p>

        @if (session('message'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center">
                {{ session('message') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between gap-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                    <i class="fas fa-paper-plane mr-2"></i> Resend Verification Email
                </button>
            </form>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 text-center">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm text-gray-600 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 underline transition">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
