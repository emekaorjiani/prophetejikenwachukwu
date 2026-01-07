@extends('layouts.app')

@section('title', 'Admin - Contact Messages')

@section('content')
@include('admin.nav')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold mb-8">
        <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">Contact Messages</span>
    </h1>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-600 to-red-600">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Email</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Subject</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Message</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Date</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($messages as $message)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->subject ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $message->message }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                {{ $message->status === 'new' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($message->status === 'read' ? 'bg-blue-100 text-blue-800' : 
                                   ($message->status === 'replied' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')) }}">
                                {{ ucfirst($message->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $message->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button onclick="viewModal({{ $message->id }})" class="text-blue-600 hover:text-blue-800 mr-3">View</button>
                            <form action="{{ route('admin.contacts.destroy', $message) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-6 py-12 text-center text-gray-500">No messages found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($messages->hasPages())
        <div class="mt-4">{{ $messages->links() }}</div>
    @endif
</div>
@endsection


