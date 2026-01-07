@extends('layouts.app')

@section('title', 'Admin - Users')

@section('content')
@include('admin.nav')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-bold mb-8">
        <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">Users Management</span>
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
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Role</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Joined</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_banned)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Banned</span>
                                @if($user->ban_reason)
                                    <div class="text-xs text-gray-500 mt-1">{{ \Illuminate\Support\Str::limit($user->ban_reason, 30) }}</div>
                                @endif
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Active</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($user->is_banned)
                                <form action="{{ route('admin.users.unban', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-800 mr-3">Unban</button>
                                </form>
                            @else
                                <button onclick="banModal({{ $user->id }})" class="text-red-600 hover:text-red-800 mr-3">Ban</button>
                            @endif
                            <form action="{{ route('admin.users.reset-password', $user) }}" method="POST" class="inline" onsubmit="return confirm('Reset password and send email?')">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:text-blue-800">Reset Password</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-6 py-12 text-center text-gray-500">No users found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($users->hasPages())
        <div class="mt-4">{{ $users->links() }}</div>
    @endif
</div>

<!-- Ban Modal -->
<div id="banModal" class="fixed inset-0 bg-black bg-opacity-50 z-[9999] hidden items-center justify-center p-4" style="display: none;">
    <div class="bg-white rounded-3xl max-w-md w-full shadow-2xl">
        <div class="p-6 border-b">
            <h3 class="text-2xl font-bold">Ban User</h3>
        </div>
        <form id="banForm" method="POST" class="p-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold mb-2">Ban Reason *</label>
                <textarea name="ban_reason" required rows="4" class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200"></textarea>
            </div>
            <div class="flex gap-4 mt-4">
                <button type="submit" class="flex-1 py-3 rounded-full bg-red-600 text-white font-semibold hover:bg-red-700">Ban User</button>
                <button type="button" onclick="closeBanModal()" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700">Cancel</button>
            </div>
        </form>
    </div>
</div>

<script>
function banModal(userId) {
    document.getElementById('banForm').action = `/admin/users/${userId}/ban`;
    const modal = document.getElementById('banModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

function closeBanModal() {
    const modal = document.getElementById('banModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
    document.body.style.overflow = ''; // Restore scrolling
}

// Close modal on outside click
document.getElementById('banModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeBanModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('banModal');
        if (modal && !modal.classList.contains('hidden')) {
            closeBanModal();
        }
    }
});
</script>
@endsection

