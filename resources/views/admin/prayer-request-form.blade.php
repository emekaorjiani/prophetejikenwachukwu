@extends('layouts.app')

@section('title', 'Edit Prayer Request')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @include('admin.nav')

    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                Edit Prayer Request
            </span>
        </h1>
        <p class="text-gray-600">Update prayer request details and response</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg p-8">
        <form action="{{ route('admin.prayer-request.update', $prayerRequest) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                <input type="text" value="{{ $prayerRequest->name }}" readonly class="w-full px-4 py-3 rounded-full border-2 border-gray-200 bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" value="{{ $prayerRequest->email }}" readonly class="w-full px-4 py-3 rounded-full border-2 border-gray-200 bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
                <input type="tel" value="{{ $prayerRequest->phone ?? '' }}" readonly class="w-full px-4 py-3 rounded-full border-2 border-gray-200 bg-gray-50">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Country</label>
                <input type="text" value="{{ $prayerRequest->country ?? 'Not provided' }}" readonly class="w-full px-4 py-3 rounded-full border-2 border-gray-200 bg-gray-50">
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">State/Province</label>
                    <input type="text" value="{{ $prayerRequest->state ?? 'Not provided' }}" readonly class="w-full px-4 py-3 rounded-full border-2 border-gray-200 bg-gray-50">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">City</label>
                    <input type="text" value="{{ $prayerRequest->city ?? 'Not provided' }}" readonly class="w-full px-4 py-3 rounded-full border-2 border-gray-200 bg-gray-50">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                <textarea readonly rows="2" class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 bg-gray-50 resize-none">{{ $prayerRequest->address ?? 'Not provided' }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Prayer Request</label>
                <textarea readonly rows="6" class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 bg-gray-50 resize-none">{{ $prayerRequest->request }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                <select name="status" required class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                    <option value="pending" {{ $prayerRequest->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="responded" {{ $prayerRequest->status === 'responded' ? 'selected' : '' }}>Responded</option>
                </select>
                @error('status')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Response Platform</label>
                <select name="response_platform" class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                    <option value="">Select Platform</option>
                    <option value="youtube" {{ $prayerRequest->response_platform === 'youtube' ? 'selected' : '' }}>YouTube</option>
                    <option value="facebook" {{ $prayerRequest->response_platform === 'facebook' ? 'selected' : '' }}>Facebook</option>
                    <option value="tiktok" {{ $prayerRequest->response_platform === 'tiktok' ? 'selected' : '' }}>TikTok</option>
                    <option value="instagram" {{ $prayerRequest->response_platform === 'instagram' ? 'selected' : '' }}>Instagram</option>
                </select>
                @error('response_platform')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Response</label>
                <textarea name="response" rows="6" class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('response', $prayerRequest->response ?? '') }}</textarea>
                @error('response')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">
                    Update Request
                </button>
                <a href="{{ route('admin.index') }}" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-all flex items-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

