@extends('layouts.app')

@section('title', 'Admin - Visitors')

@section('content')
@include('admin.nav')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold mb-8">
        <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">Visitor Statistics</span>
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="text-3xl font-bold text-blue-600">{{ number_format($totalVisitors) }}</div>
            <div class="text-gray-600 mt-2">Total Visitors</div>
        </div>
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="text-3xl font-bold text-green-600">{{ number_format($activeVisitors) }}</div>
            <div class="text-gray-600 mt-2">Active Now</div>
        </div>
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="text-3xl font-bold text-purple-600">{{ number_format($todayVisitors) }}</div>
            <div class="text-gray-600 mt-2">Today</div>
        </div>
        <div class="bg-white rounded-3xl shadow-lg p-6">
            <div class="text-3xl font-bold text-red-600">{{ number_format($visitors->total()) }}</div>
            <div class="text-gray-600 mt-2">Total Records</div>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-red-600">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">IP Address</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Location</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Visits</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Last Activity</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($visitors as $visitor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visitor->ip_address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visitor->city ?? 'Unknown' }}, {{ $visitor->country ?? 'Unknown' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visitor->visit_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $visitor->last_activity ? $visitor->last_activity->diffForHumans() : '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $visitor->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $visitor->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No visitors found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($visitors->hasPages())
        <div class="mt-4">{{ $visitors->links() }}</div>
    @endif
</div>
@endsection


