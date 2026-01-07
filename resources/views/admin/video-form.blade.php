@extends('layouts.app')

@section('title', isset($video) ? 'Edit Video' : 'Add Video')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @include('admin.nav')

    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                {{ isset($video) ? 'Edit Video' : 'Add Video' }}
            </span>
        </h1>
        <p class="text-gray-600">{{ isset($video) ? 'Update video details' : 'Add a new video' }}</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg p-8">
        <form action="{{ isset($video) ? route('admin.videos.update', $video) : route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($video)) @method('PUT') @endif

            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $video->title ?? '') }}" required
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('title')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('description', $video->description ?? '') }}</textarea>
                @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="platform" class="block text-sm font-semibold text-gray-700 mb-2">Platform *</label>
                <select name="platform" id="platform" required
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                    <option value="youtube" {{ old('platform', $video->platform ?? '') === 'youtube' ? 'selected' : '' }}>YouTube</option>
                    <option value="facebook" {{ old('platform', $video->platform ?? '') === 'facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="tiktok" {{ old('platform', $video->platform ?? '') === 'tiktok' ? 'selected' : '' }}>TikTok</option>
                    <option value="instagram" {{ old('platform', $video->platform ?? '') === 'instagram' ? 'selected' : '' }}>Instagram</option>
                    <option value="other" {{ old('platform', $video->platform ?? '') === 'other' || (isset($video) && $video->video_file) ? 'selected' : '' }}>Other / Upload File</option>
                </select>
                @error('platform')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div id="video-url-field" class="{{ (isset($video) && $video->video_file) || old('platform') === 'other' ? 'hidden' : '' }}">
                <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">Video URL</label>
                <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $video->video_url ?? '') }}"
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none" placeholder="https://youtube.com/watch?v=...">
                @error('video_url')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-gray-500 mt-1">Enter video URL (YouTube, Facebook, etc.)</p>
            </div>

            <div id="video-file-field" class="{{ (!isset($video) || !$video->video_file) && old('platform') !== 'other' ? 'hidden' : '' }}">
                <label for="video_file" class="block text-sm font-semibold text-gray-700 mb-2">Upload Video File</label>
                <input type="file" id="video_file" name="video_file" accept="video/*"
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('video_file')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-gray-500 mt-1">Max size: 100MB. Supported: MP4, AVI, MOV, WMV, FLV, WebM</p>
                @if(isset($video) && $video->video_file)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Current Video File:</p>
                        <video src="{{ asset('storage/' . $video->video_file) }}" controls class="w-64 h-auto rounded-lg shadow-md"></video>
                        <p class="text-xs text-blue-600 mt-2">Upload a new file to replace the existing one.</p>
                    </div>
                @endif
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">Thumbnail Image</label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('thumbnail')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                <p class="text-xs text-gray-500 mt-1">Optional: Upload a thumbnail image</p>
                @if(isset($video) && $video->thumbnail)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600 mb-2">Current Thumbnail:</p>
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="Video Thumbnail" class="w-32 h-32 object-cover rounded-lg shadow-md">
                    </div>
                @endif
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_featured" value="1" id="is_featured" class="mr-2 w-5 h-5"
                    {{ old('is_featured', isset($video) && $video->is_featured ? 'checked' : '') }}>
                <label for="is_featured" class="text-sm font-semibold text-gray-700">Featured</label>
            </div>

            <div>
                <label for="order" class="block text-sm font-semibold text-gray-700 mb-2">Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', $video->order ?? 0) }}"
                    class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                @error('order')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">
                    {{ isset($video) ? 'Update Video' : 'Create Video' }}
                </button>
                <a href="{{ route('admin.videos') }}" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-all flex items-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const platformSelect = document.getElementById('platform');
    const videoUrlField = document.getElementById('video-url-field');
    const videoFileField = document.getElementById('video-file-field');
    const videoUrlInput = document.getElementById('video_url');
    const videoFileInput = document.getElementById('video_file');

    platformSelect.addEventListener('change', function() {
        if (this.value === 'other') {
            videoUrlField.classList.add('hidden');
            videoFileField.classList.remove('hidden');
            videoUrlInput.removeAttribute('required');
        } else {
            videoUrlField.classList.remove('hidden');
            videoFileField.classList.add('hidden');
            videoUrlInput.setAttribute('required', 'required');
        }
    });
});
</script>
@endsection


