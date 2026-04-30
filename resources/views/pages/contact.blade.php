@extends('layouts.app')

@section('title', 'Contact Us - ThriftMotors')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold mb-4 dark:text-white">Contact Us</h1>
        <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md border border-transparent dark:border-gray-700 p-8 transition-colors duration-300">
        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Your Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-red-500 focus:border-red-500 dark:text-white">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Your Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-red-500 focus:border-red-500 dark:text-white">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-red-500 focus:border-red-500 dark:text-white">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Message</label>
                <textarea name="message" rows="5" required class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-red-500 focus:border-red-500 dark:text-white">{{ old('message') }}</textarea>
                @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="bg-red-600 text-white font-bold py-3 px-8 rounded-full hover:bg-red-700 transition w-full md:w-auto">
                    Send Message <i class="fas fa-paper-plane ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
