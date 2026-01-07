<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Prophet Ejike Nwachukwu - Rhema Deliverance Mission International')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 via-white to-red-50">
    <!-- Background Pattern -->
    <div class="fixed inset-0 opacity-5 pointer-events-none">
        <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(59, 130, 246, 0.1) 35px, rgba(59, 130, 246, 0.1) 70px), repeating-linear-gradient(-45deg, transparent, transparent 35px, rgba(239, 68, 68, 0.1) 35px, rgba(239, 68, 68, 0.1) 70px);"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-50 bg-white/80 backdrop-blur-md border-b border-blue-100/50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                        Prophet Ejike Nwachukwu
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}#about" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">About</a>
                    <a href="{{ route('home') }}#testimonies" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Testimonies</a>
                    <a href="{{ route('home') }}#videos" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Videos</a>
                    <a href="{{ route('home') }}#prayer" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Prayer Request</a>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.index') }}" class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors font-medium">Admin</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors font-medium">My Requests</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="px-4 py-2 rounded-full bg-red-600 text-white hover:bg-red-700 transition-colors font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition-colors font-medium">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-red-600 text-white hover:bg-red-700 transition-colors font-medium">Register</a>
                    @endauth
                </div>
                <button class="md:hidden text-gray-700" id="mobile-menu-button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-4 pt-2 pb-4 space-y-2 bg-white border-t">
                <a href="{{ route('home') }}#about" class="block py-2 text-gray-700 hover:text-blue-600">About</a>
                <a href="{{ route('home') }}#testimonies" class="block py-2 text-gray-700 hover:text-blue-600">Testimonies</a>
                <a href="{{ route('home') }}#videos" class="block py-2 text-gray-700 hover:text-blue-600">Videos</a>
                <a href="{{ route('home') }}#prayer" class="block py-2 text-gray-700 hover:text-blue-600">Prayer Request</a>
                <a href="http://rhemadelmission.org/" target="_blank" class="block py-2 text-gray-700 hover:text-red-600">Rhema Mission</a>
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.index') }}" class="block py-2 px-4 rounded-full bg-blue-600 text-white text-center mb-2">Admin</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="block py-2 px-4 rounded-full bg-blue-600 text-white text-center mb-2">My Requests</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full py-2 px-4 rounded-full bg-red-600 text-white text-center">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 px-4 rounded-full bg-blue-600 text-white text-center mb-2">Login</a>
                    <a href="{{ route('register') }}" class="block py-2 px-4 rounded-full bg-red-600 text-white text-center">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="relative z-10">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full shadow-sm">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-full shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative z-10 bg-gradient-to-r from-blue-900 to-red-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Prophet Ejike Nwachukwu</h3>
                    <p class="text-blue-100">Rhema Deliverance Mission International<br>(The Power Line of the Holy Spirit)</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 flex items-center justify-center transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.07 1.09-.43 2.03-1.02 2.8-.83.98-2.05 1.03-3.08.27-1.38-1.21-1.38-3.52.06-4.78.33-.28.75-.51 1.2-.64-.58.18-1.1.5-1.52.96-.42.46-.68 1.03-.75 1.62-.1.9.26 1.79 1.01 2.32.78.55 1.85.57 2.64.14.88-.49 1.34-1.46 1.32-2.46-.02-1.18-.05-2.36-.05-3.54 0-1.67-.03-3.35.01-5.02z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-blue-100">
                        <li><a href="{{ route('home') }}#about" class="hover:text-white transition-colors">About Ministry</a></li>
                        <li><a href="{{ route('home') }}#testimonies" class="hover:text-white transition-colors">Testimonies</a></li>
                        <li><a href="{{ route('home') }}#videos" class="hover:text-white transition-colors">Video Gallery</a></li>
                        <li><a href="{{ route('home') }}#prayer" class="hover:text-white transition-colors">Prayer Request</a></li>
                        <li><a href="http://rhemadelmission.org/" target="_blank" class="hover:text-white transition-colors">Rhema Mission</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-white/20 text-center text-blue-100">
                <p>&copy; {{ date('Y') }} Prophet Ejike Nwachukwu. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>

