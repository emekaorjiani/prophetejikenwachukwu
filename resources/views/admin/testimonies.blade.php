@extends('layouts.app')

@section('title', 'Admin - Testimonies')

@section('content')
@include('admin.nav')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-4xl font-bold">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">Testimonies Management</span>
        </h1>
        <a href="{{ route('admin.testimonies.create') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">Add Testimony</a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-red-600">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Photo</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Location</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Testimony</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Featured</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($testimonies as $testimony)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($testimony->photo)
                                <img src="{{ asset('storage/' . $testimony->photo) }}" alt="{{ $testimony->name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-red-500 flex items-center justify-center text-white font-bold">
                                    {{ substr($testimony->name, 0, 1) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $testimony->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $testimony->location ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $testimony->testimony }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($testimony->is_approved)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    Approved
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $testimony->is_featured ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $testimony->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col gap-1">
                                @if(!$testimony->is_approved)
                                    <form action="{{ route('admin.testimonies.approve', $testimony) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800 text-sm">Approve</button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.testimonies.reject', $testimony) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-orange-600 hover:text-orange-800 text-sm">Reject</button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.testimonies.edit', $testimony) }}" class="text-blue-600 hover:text-blue-800 text-sm">Edit</a>
                                <form action="{{ route('admin.testimonies.destroy', $testimony) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-12 text-center text-gray-500">No testimonies found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($testimonies->hasPages())
        <div class="mt-4">{{ $testimonies->links() }}</div>
    @endif
</div>
@endsection

