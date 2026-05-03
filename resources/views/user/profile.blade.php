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
            <div class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8 pb-8 border-b dark:border-gray-700">
                <div class="relative group">
                    <img id="avatar-preview" 
                         src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=128&color=7F9CF5&background=EBF4FF' }}" 
                         alt="{{ $user->name }}" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-xl">
                    <label for="avatar-input" class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-full opacity-0 group-hover:opacity-100 cursor-pointer transition">
                        <i class="fas fa-camera text-white text-2xl"></i>
                    </label>
                    <input type="file" name="avatar" id="avatar-input" class="hidden" accept="image/*" onchange="previewImage(this)">
                    <input type="hidden" name="cropped_avatar" id="cropped-data">
                </div>
                
                <div class="flex-1 text-center md:text-left">
                    <h3 class="text-xl font-bold dark:text-white mb-1">Profile Photo</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Click the photo or use the buttons below to manage your avatar.</p>
                    
                    <div class="flex flex-wrap justify-center md:justify-start gap-2">
                        {{-- VIEW BUTTON --}}
                        <button type="button" 
                                onclick="document.getElementById('view-modal').classList.remove('hidden')"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition text-sm font-semibold">
                            <i class="fas fa-eye mr-2"></i> View
                        </button>

                        {{-- EDIT BUTTON --}}
                        <button type="button" 
                                onclick="document.getElementById('avatar-input').click()"
                                class="inline-flex items-center px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition text-sm font-semibold">
                            <i class="fas fa-pen mr-2"></i> Change
                        </button>

                        {{-- DELETE BUTTON --}}
                        @if($user->avatar)
                            <button type="button" 
                                    onclick="if(confirm('Are you sure you want to remove your profile photo?')) document.getElementById('delete-avatar-form').submit();"
                                    class="inline-flex items-center px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 transition text-sm font-semibold">
                                <i class="fas fa-trash-alt mr-2"></i> Remove
                            </button>
                        @endif
                    </div>
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

{{-- Hidden Delete Form --}}
<form id="delete-avatar-form" action="{{ route('user.profile.avatar.destroy') }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

{{-- View Modal --}}
<div id="view-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/90" onclick="document.getElementById('view-modal').classList.add('hidden')"></div>
    <div class="relative max-w-2xl w-full flex flex-col items-center">
        <button onclick="document.getElementById('view-modal').classList.add('hidden')" class="absolute -top-12 right-0 text-white text-4xl">&times;</button>
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=512&color=7F9CF5&background=EBF4FF' }}" 
             alt="{{ $user->name }}" 
             class="max-w-full max-h-[80vh] rounded-lg shadow-2xl border-4 border-white dark:border-gray-800">
        <p class="text-white mt-4 font-semibold text-lg">{{ $user->name }}</p>
    </div>
</div>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
<style>
    .cropper-view-box, .cropper-face {
        border-radius: 50%;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<script>
    let cropper;
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    const cropModal = document.getElementById('crop-modal');
    const cropImage = document.getElementById('crop-image');
    const croppedDataInput = document.getElementById('cropped-data');

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                cropImage.src = e.target.result;
                cropModal.classList.remove('hidden');
                
                if (cropper) {
                    cropper.destroy();
                }
                
                cropper = new Cropper(cropImage, {
                    aspectRatio: 1,
                    viewMode: 2,
                    guides: true,
                    autoCropArea: 1,
                    responsive: true,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function cancelCrop() {
        cropModal.classList.add('hidden');
        avatarInput.value = '';
        if (cropper) {
            cropper.destroy();
        }
    }

    function applyCrop() {
        const canvas = cropper.getCroppedCanvas({
            width: 400,
            height: 400,
        });
        
        avatarPreview.src = canvas.toDataURL();
        croppedDataInput.value = canvas.toDataURL(); // Send as base64
        cropModal.classList.add('hidden');
    }
</script>
@endpush

{{-- Cropping Modal --}}
<div id="crop-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
    <div class="absolute inset-0 bg-black/60" onclick="cancelCrop()"></div>
    <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden z-10 border dark:border-gray-700">
        <div class="p-4 border-b dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-bold dark:text-white">Crop & Center Photo</h3>
            <button onclick="cancelCrop()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 text-2xl leading-none">&times;</button>
        </div>
        <div class="p-6">
            <div class="max-h-[60vh] overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-900">
                <img id="crop-image" src="" class="max-w-full">
            </div>
            <p class="text-xs text-gray-500 mt-4 text-center">Drag to move and resize the circle to center your face.</p>
        </div>
        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 flex gap-3">
            <button type="button" onclick="applyCrop()" class="flex-1 bg-red-600 text-white py-2 rounded-lg font-bold hover:bg-red-700 transition">
                Apply Crop
            </button>
            <button type="button" onclick="cancelCrop()" class="flex-1 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-white py-2 rounded-lg font-bold hover:bg-gray-300 dark:hover:bg-gray-500 transition">
                Cancel
            </button>
        </div>
    </div>
</div>
@endsection
