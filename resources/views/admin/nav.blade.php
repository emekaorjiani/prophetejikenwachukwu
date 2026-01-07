<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-white rounded-3xl shadow-lg p-4">
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
</div>


