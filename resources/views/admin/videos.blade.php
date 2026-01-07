@extends('layouts.app')

@section('title', 'Admin - Videos')

@section('content')
@include('admin.nav')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-4xl font-bold">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">Videos Management</span>
        </h1>
        <a href="{{ route('admin.videos.create') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">Add Video</a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-red-600">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Thumbnail</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Title</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Platform</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Type</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Featured</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($videos as $video)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="w-16 h-10 object-cover rounded">
                            @else
                                <div class="w-16 h-10 bg-gradient-to-br from-blue-100 to-red-100 rounded flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $video->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">{{ ucfirst($video->platform) }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($video->video_file)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">Uploaded File</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">URL</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $video->is_featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $video->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.videos.edit', $video) }}" class="text-blue-600 hover:text-blue-800 mr-3">Edit</a>
                            <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">No videos found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($videos->hasPages())
        <div class="mt-4">{{ $videos->links() }}</div>
    @endif
</div>
@endsection
