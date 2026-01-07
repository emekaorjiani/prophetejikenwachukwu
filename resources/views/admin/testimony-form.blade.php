@extends('layouts.app')

@section('title', isset($testimony) ? 'Edit Testimony' : 'Add Testimony')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @include('admin.nav')

    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                {{ isset($testimony) ? 'Edit Testimony' : 'Add Testimony' }}
            </span>
        </h1>
        <p class="text-gray-600">{{ isset($testimony) ? 'Update testimony details' : 'Create a new testimony' }}</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg p-8">
        <form action="{{ isset($testimony) ? route('admin.testimonies.update', $testimony) : route('admin.testimonies.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($testimony)) @method('PUT') @endif

            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $testimony->name ?? '') }}" required
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="location" class="block text-sm font-semibold text-gray-700 mb-2">Location</label>
                <input type="text" id="location" name="location" value="{{ old('location', $testimony->location ?? '') }}"
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('location')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="testimony" class="block text-sm font-semibold text-gray-700 mb-2">Testimony *</label>
                <textarea id="testimony" name="testimony" rows="6" required
                    class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('testimony', $testimony->testimony ?? '') }}</textarea>
                @error('testimony')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="photo" class="block text-sm font-semibold text-gray-700 mb-2">Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*"
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('photo')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                @if(isset($testimony) && $testimony->photo)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Current Photo:</p>
                        <img src="{{ asset('storage/' . $testimony->photo) }}" alt="Testimony Photo" class="w-32 h-32 object-cover rounded-lg shadow-md">
                    </div>
                @endif
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_approved" value="1" id="is_approved" class="mr-2 w-5 h-5"
                    {{ old('is_approved', isset($testimony) && $testimony->is_approved ? 'checked' : 'checked') }}>
                <label for="is_approved" class="text-sm font-semibold text-gray-700">Approved</label>
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" class="mr-2 w-5 h-5"
                    {{ old('is_featured', isset($testimony) && $testimony->is_featured ? 'checked' : '') }}>
                <label for="is_featured" class="text-sm font-semibold text-gray-700">Featured</label>
            </div>

            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', $testimony->order ?? 0) }}"
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('order')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">
                    {{ isset($testimony) ? 'Update Testimony' : 'Create Testimony' }}
                </button>
                <a href="{{ route('admin.testimonies') }}" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-all flex items-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

