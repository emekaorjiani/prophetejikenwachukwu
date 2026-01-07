@extends('layouts.app')

@section('title', 'Admin - Prayer Requests')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Admin Navigation -->
    <div class="mb-8 bg-white rounded-3xl shadow-lg p-4">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.index') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('admin.index') ? 'bg-gradient-to-r from-blue-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all">
                Prayer Requests
            </a>
            <a href="{{ route('admin.testimonies') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('admin.testimonies*') ? 'bg-gradient-to-r from-blue-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all">
                Testimonies
            </a>
            <a href="{{ route('admin.videos') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('admin.videos*') ? 'bg-gradient-to-r from-blue-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all">
                Videos
            </a>
            <a href="{{ route('admin.visitors') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('admin.visitors') ? 'bg-gradient-to-r from-blue-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all">
                Visitors
            </a>
            <a href="{{ route('admin.contacts') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('admin.contacts*') ? 'bg-gradient-to-r from-blue-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all">
                Contact Messages
            </a>
            <a href="{{ route('admin.users') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('admin.users*') ? 'bg-gradient-to-r from-blue-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all">
                Users
            </a>
            <a href="{{ route('admin.email-templates') }}" class="px-4 py-2 rounded-full {{ request()->routeIs('admin.email-templates*') || request()->routeIs('admin.send-email') ? 'bg-gradient-to-r from-blue-600 to-red-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition-all">
                Email Templates
            </a>
        </div>
    </div>

    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold mb-2">
                <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                    Prayer Requests Management
                </span>
            </h1>
            <p class="text-gray-600">Manage and respond to prayer requests</p>
        </div>
        <a href="{{ route('admin.download') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all transform hover:scale-105 shadow-lg">
            Download CSV
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-600 to-red-600">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">ID</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Email</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Location</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Request</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Platform</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($requests as $request)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $request->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $request->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $request->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                @if($request->country)
                                    <div class="flex flex-col">
                                        <span class="font-semibold">{{ $request->country }}</span>
                                        @if($request->city || $request->state)
                                            <span class="text-xs text-gray-500">
                                                {{ trim(($request->city ?? '') . ($request->city && $request->state ? ', ' : '') . ($request->state ?? '')) }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $request->request }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $request->status === 'responded' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($request->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                @if($request->response_platform)
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        {{ ucfirst($request->response_platform) }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $request->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('admin.prayer-request.edit', $request) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium">View/Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                No prayer requests found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($requests->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $requests->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

