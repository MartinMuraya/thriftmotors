@extends('layouts.app')

@section('title', 'My Profile - ThriftMotors')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-bold dark:text-white">Profile Information</h1>
        <p class="text-gray-600 dark:text-gray-400">Update your account's profile information and email address.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-transparent dark:border-gray-700 overflow-hidden transition-colors duration-300">
        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PATCH')

            <!-- Avatar Section -->
            <div class="flex items-center space-x-6 pb-6 border-b dark:border-gray-700">
                <div class="relative group">
                    <img id="avatar-preview" 
                         src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=128&color=7F9CF5&background=EBF4FF' }}" 
                         alt="{{ $user->name }}" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg">
                    <label for="avatar-input" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition">
                        <i class="fas fa-camera text-white text-2xl"></i>
                    </label>
                    <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                </div>
                <div>
                    <h3 class="text-lg font-semibold dark:text-white">Profile Photo</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Click the image to upload a new one.</p>
                    @error('avatar')
                        <p class="text-red-600 text-xs">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold mb-2 dark:text-gray-300">Email Address</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required 
                           class="w-full px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 dark:text-white">
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-red-600 text-white px-8 py-2 rounded-lg hover:bg-red-700 transition font-semibold">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatar-preview').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
@endsection
