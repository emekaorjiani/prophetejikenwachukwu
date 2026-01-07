@extends('layouts.app')

@section('title', 'Prophet Ejike Nwachukwu - Rhema Deliverance Mission International')

@section('content')
    <!-- Hero Section with Video -->
    <section class="relative w-full h-[70vh] flex items-center justify-center overflow-hidden">
        <!-- Video Background -->
        <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover z-0">
            <source src="{{ asset('images/mog.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <!-- Darker Overlay for better text readability -->
        <div class="absolute inset-0 bg-black/60 z-[1]"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/50 via-transparent to-red-900/50 z-[1]"></div>

        <!-- Content Overlay - Centered -->
        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 text-center">
            <!-- Text Content -->
            <div class="mb-8">
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 drop-shadow-2xl">
                    <span class="bg-gradient-to-r from-blue-300 via-purple-300 to-red-300 bg-clip-text text-transparent">
                        Prophet Ejike Nwachukwu
                    </span>
                </h1>
                <p class="text-2xl md:text-3xl font-semibold text-white mb-2 drop-shadow-lg backdrop-blur-sm px-4 py-2 rounded-full inline-block bg-black/30">
                    Rhema Deliverance Mission International
                </p>
                <p class="text-xl text-blue-100 italic drop-shadow-md backdrop-blur-sm px-4 py-2 rounded-full block bg-black/20 mt-4">
                    The Power Line of the Holy Spirit
                </p>
            </div>

            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <a href="#prayer" class="px-8 py-4 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold hover:from-blue-700 hover:to-blue-800 transition-all transform hover:scale-105 shadow-2xl backdrop-blur-sm border-2 border-white/30">
                    Request Prayer
                </a>
                <a href="#about" class="px-8 py-4 rounded-full bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold hover:from-red-700 hover:to-red-800 transition-all transform hover:scale-105 shadow-2xl backdrop-blur-sm border-2 border-white/30">
                    Learn More
                </a>
            </div>

            <!-- Social Media Links -->
            <div class="flex justify-center space-x-6">
                <a href="#" class="w-14 h-14 rounded-full bg-blue-600/90 hover:bg-blue-700 backdrop-blur-sm border-2 border-white/30 text-white flex items-center justify-center transition-all transform hover:scale-110 shadow-xl">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" class="w-14 h-14 rounded-full bg-red-600/90 hover:bg-red-700 backdrop-blur-sm border-2 border-white/30 text-white flex items-center justify-center transition-all transform hover:scale-110 shadow-xl">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
                <a href="#" class="w-14 h-14 rounded-full bg-pink-600/90 hover:bg-pink-700 backdrop-blur-sm border-2 border-white/30 text-white flex items-center justify-center transition-all transform hover:scale-110 shadow-xl">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.07 1.09-.43 2.03-1.02 2.8-.83.98-2.05 1.03-3.08.27-1.38-1.21-1.38-3.52.06-4.78.33-.28.75-.51 1.2-.64-.58.18-1.1.5-1.52.96-.42.46-.68 1.03-.75 1.62-.1.9.26 1.79 1.01 2.32.78.55 1.85.57 2.64.14.88-.49 1.34-1.46 1.32-2.46-.02-1.18-.05-2.36-.05-3.54 0-1.67-.03-3.35.01-5.02z"/></svg>
                </a>
                <a href="#" class="w-14 h-14 rounded-full bg-gradient-to-r from-purple-600/90 to-pink-600/90 hover:from-purple-700 hover:to-pink-700 backdrop-blur-sm border-2 border-white/30 text-white flex items-center justify-center transition-all transform hover:scale-110 shadow-xl">
                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Image Section with Quote -->
    <section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <!-- Image -->
                <div class="flex justify-center md:justify-start order-2 md:order-1">
                    <img src="{{ asset('images/mog-1.png') }}" alt="Prophet Ejike Nwachukwu" class="w-full max-w-lg lg:max-w-2xl xl:max-w-3xl h-auto object-contain drop-shadow-2xl">
                </div>

                <!-- Quote Content -->
                <div class="text-center md:text-left order-1 md:order-2 space-y-4">
                    <div class="inline-block">
                        <svg class="w-12 h-12 text-blue-300 mb-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.996 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.984zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/>
                        </svg>
                    </div>
                    <blockquote class="text-2xl md:text-3xl lg:text-4xl font-bold text-white leading-relaxed">
                        "The power of the Holy Spirit transforms lives, breaks chains, and brings deliverance to all who believe."
                    </blockquote>
                    <div class="pt-2">
                        <p class="text-lg md:text-xl text-blue-200 font-semibold">— Prophet Ejike Nwachukwu</p>
                        <p class="text-base text-blue-300 mt-1">Rhema Deliverance Mission International</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="relative py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="bg-linear-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                        About the Ministry
                    </span>
                </h2>
                <div class="w-24 h-1 bg-gradiet-to-r from-blue-600 to-red-600 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Rhema Deliverance Mission International</h3>
                    <p class="text-lg text-gray-600 mb-4 leading-relaxed">
                        Also known as <strong>"The Power Line of the Holy Spirit"</strong>, Rhema Deliverance Mission International is a dynamic ministry led by Prophet Ejike Nwachukwu, dedicated to spreading the gospel and bringing deliverance, healing, and transformation to lives across the globe.
                    </p>
                    <p class="text-lg text-gray-600 mb-4 leading-relaxed">
                        Through the power of the Holy Spirit, the ministry has witnessed countless miracles, healings, and testimonies of God's faithfulness. Prophet Ejike Nwachukwu operates in the prophetic, healing, and deliverance ministry, bringing hope and restoration to many.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        The ministry reaches millions through various platforms including YouTube, Facebook, TikTok, and Instagram, sharing the message of salvation and the power of God's word.
                    </p>
                    <div class="mt-8">
                        <a href="http://rhemadelmission.org/" target="_blank" class="inline-block px-8 py-4 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all transform hover:scale-105 shadow-lg">
                            Visit Rhema Mission
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-200 to-red-200 rounded-3xl transform rotate-6"></div>
                    <div class="relative bg-white p-8 rounded-3xl shadow-2xl">
                        <div class="rounded-2xl overflow-hidden">
                            <img src="{{ asset('images/youngprophet.JPG') }}" alt="Prophet Ejike Nwachukwu" class="w-full h-auto object-cover rounded-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonies Section -->
    <section id="testimonies" class="relative py-20 bg-gradient-to-br from-blue-50 to-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                        Testimonies
                    </span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-red-600 mx-auto mb-4"></div>
                <p class="text-xl text-gray-600">Stories of God's faithfulness and miracles</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($testimonies as $testimony)
                    <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2">
                        <div class="flex items-center mb-6">
                            @if($testimony->photo)
                                <img src="{{ asset('storage/' . $testimony->photo) }}" alt="{{ $testimony->name }}" class="w-16 h-16 rounded-full object-cover">
                            @else
                                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-500 to-red-500 flex items-center justify-center text-white text-2xl font-bold">
                                    {{ substr($testimony->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="ml-4">
                                <h4 class="font-bold text-gray-800">{{ $testimony->name }}</h4>
                                @if($testimony->location)
                                    <p class="text-sm text-gray-500">{{ $testimony->location }}</p>
                                @endif
                            </div>
                        </div>
                        <p class="text-gray-600 leading-relaxed italic">"{{ $testimony->testimony }}"</p>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Testimonies will be displayed here</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Video Gallery Section -->
    <section id="videos" class="relative py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                        Video Gallery
                    </span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-red-600 mx-auto mb-4"></div>
                <p class="text-xl text-gray-600">Watch powerful messages and testimonies</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($videos as $video)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-2">
                        <div class="aspect-video bg-gradient-to-br from-blue-100 to-red-100 relative">
                            @if($video->video_file)
                                <!-- Uploaded Video File -->
                                <video class="w-full h-full object-cover" controls>
                                    <source src="{{ asset('storage/' . $video->video_file) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @elseif($video->platform === 'youtube' && $video->video_url)
                                <!-- YouTube Embed -->
                                <iframe class="w-full h-full" src="{{ str_replace('watch?v=', 'embed/', $video->video_url) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @elseif($video->thumbnail)
                                <!-- Thumbnail with play button -->
                                <div class="w-full h-full relative">
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black/30">
                                        <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                            @else
                                <!-- Default placeholder -->
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-16 h-16 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8 5v14l11-7z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 mb-2 line-clamp-2">{{ $video->title }}</h4>
                            @if($video->description)
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $video->description }}</p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500 text-lg">Videos will be displayed here</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Prayer Request Section -->
    <section id="prayer" class="relative py-20 bg-gradient-to-br from-blue-600 to-red-600">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 50px, rgba(255,255,255,0.1) 50px, rgba(255,255,255,0.1) 100px);"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 text-white">
                <h2 class="text-4xl md:text-5xl font-bold mb-4">Request for Prayer</h2>
                <div class="w-24 h-1 bg-white mx-auto mb-4"></div>
                <p class="text-xl text-blue-100">Submit your prayer request and the Man of God will respond</p>
            </div>

            <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl">
                <form action="{{ route('prayer-request.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}"
                                class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number (Optional)</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors">
                    </div>

                    <div>
                        <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">Country *</label>
                        <select id="country" name="country" required
                            class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors">
                            <option value="">Select Country</option>
                            @include('partials.countries')
                        </select>
                        @error('country')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="state" class="block text-sm font-semibold text-gray-700 mb-2">State/Province (Optional)</label>
                            <input type="text" id="state" name="state" value="{{ old('state') }}"
                                class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors">
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">City (Optional)</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}"
                                class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address (Optional)</label>
                        <textarea id="address" name="address" rows="2"
                            class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors resize-none">{{ old('address') }}</textarea>
                    </div>

                    <div>
                        <label for="request" class="block text-sm font-semibold text-gray-700 mb-2">Your Prayer Request *</label>
                        <textarea id="request" name="request" rows="6" required
                            class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none transition-colors resize-none">{{ old('request') }}</textarea>
                    </div>

                    <div class="bg-blue-50 border-l-4 border-blue-600 p-4 rounded-lg">
                        <p class="text-sm text-gray-700">
                            <strong>Important:</strong> After submitting your prayer request, please create an account to access your profile and track your requests. The Man of God will respond to your request through our YouTube, Facebook, TikTok, and Instagram platforms.
                        </p>
                    </div>

                    <button type="submit" class="w-full py-4 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all transform hover:scale-105 shadow-lg">
                        Submit Prayer Request
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection

