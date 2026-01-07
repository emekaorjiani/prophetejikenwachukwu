@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                @if(auth()->user()->role === 'admin')
                    Admin Dashboard
                @else
                    My Dashboard
                @endif
            </span>
        </h1>
        <p class="text-gray-600">
            @if(auth()->user()->role === 'admin')
                Overview of your ministry platform
            @else
                Submit prayer requests and testimonies, and track their status
            @endif
        </p>
    </div>

    @if(auth()->user()->role === 'admin' && isset($visitorStats))
        <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <div class="text-3xl font-bold text-blue-600">{{ number_format($visitorStats['total']) }}</div>
                <div class="text-gray-600 mt-2">Total Visitors</div>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <div class="text-3xl font-bold text-green-600">{{ number_format($visitorStats['active']) }}</div>
                <div class="text-gray-600 mt-2">Active Now</div>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <div class="text-3xl font-bold text-purple-600">{{ number_format($visitorStats['today']) }}</div>
                <div class="text-gray-600 mt-2">Today</div>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <div class="text-3xl font-bold text-orange-600">{{ number_format($visitorStats['this_week']) }}</div>
                <div class="text-gray-600 mt-2">This Week</div>
            </div>
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <div class="text-3xl font-bold text-red-600">{{ number_format($visitorStats['this_month']) }}</div>
                <div class="text-gray-600 mt-2">This Month</div>
            </div>
        </div>
        <div class="mb-8">
            <a href="{{ route('admin.index') }}" class="inline-block px-6 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">
                Go to Admin Panel
            </a>
        </div>
    @endif

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">
            {{ session('success') }}
        </div>
    @endif

    @if(auth()->user()->role !== 'admin')
        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Submit Prayer Request Card -->
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Submit Prayer Request</h2>
                <form action="{{ route('dashboard.prayer-request.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone (Optional)</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">Country *</label>
                        <select id="country" name="country" required
                            class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                            <option value="">Select Country</option>
                            @include('partials.countries')
                        </select>
                        @error('country')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="state" class="block text-sm font-semibold text-gray-700 mb-2">State/Province (Optional)</label>
                            <input type="text" id="state" name="state" value="{{ old('state') }}"
                                class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        </div>
                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">City (Optional)</label>
                            <input type="text" id="city" name="city" value="{{ old('city') }}"
                                class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        </div>
                    </div>
                    <div>
                        <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">Address (Optional)</label>
                        <textarea id="address" name="address" rows="2"
                            class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('address') }}</textarea>
                    </div>
                    <div>
                        <label for="request" class="block text-sm font-semibold text-gray-700 mb-2">Prayer Request *</label>
                        <textarea id="request" name="request" rows="4" required
                            class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('request') }}</textarea>
                        @error('request')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        <p class="text-xs text-gray-500 mt-1">Minimum 10 characters</p>
                    </div>
                    <button type="submit" class="w-full py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">
                        Submit Prayer Request
                    </button>
                </form>
            </div>

            <!-- Submit Testimony Card -->
            <div class="bg-white rounded-3xl shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Submit Testimony</h2>
                <p class="text-sm text-gray-600 mb-4">Share your testimony. It will be reviewed by admin before being published.</p>
                <form action="{{ route('dashboard.testimony.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="testimony_name" class="block text-sm font-semibold text-gray-700 mb-2">Your Name *</label>
                        <input type="text" id="testimony_name" name="name" value="{{ old('name', auth()->user()->name) }}" required
                            class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="testimony_location" class="block text-sm font-semibold text-gray-700 mb-2">Location (Optional)</label>
                        <input type="text" id="testimony_location" name="location" value="{{ old('location') }}"
                            class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        @error('location')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="testimony_text" class="block text-sm font-semibold text-gray-700 mb-2">Your Testimony *</label>
                        <textarea id="testimony_text" name="testimony" rows="4" required
                            class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('testimony') }}</textarea>
                        @error('testimony')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        <p class="text-xs text-gray-500 mt-1">Minimum 20 characters</p>
                    </div>
                    <div>
                        <label for="testimony_photo" class="block text-sm font-semibold text-gray-700 mb-2">Photo (Optional)</label>
                        <input type="file" id="testimony_photo" name="photo" accept="image/*"
                            class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        @error('photo')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                        <p class="text-xs text-gray-500 mt-1">Max size: 2MB</p>
                    </div>
                    <button type="submit" class="w-full py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">
                        Submit Testimony
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- Prayer Requests Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">My Prayer Requests</h2>
        @if($prayerRequests->count() > 0)
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gradient-to-r from-blue-600 to-red-600">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Prayer Request</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Response</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Platform</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($prayerRequests as $prayerRequest)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        {{ $prayerRequest->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 max-w-md">
                                        <div class="truncate">{{ Str::limit($prayerRequest->request, 100) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $prayerRequest->status === 'responded' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($prayerRequest->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-md">
                                        @if($prayerRequest->response)
                                            <div class="truncate">{{ Str::limit($prayerRequest->response, 80) }}</div>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                        @if($prayerRequest->response_platform)
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                                {{ ucfirst($prayerRequest->response_platform) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($prayerRequests->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $prayerRequests->links() }}
                    </div>
                @endif
            </div>
        @else
            <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Prayer Requests Yet</h3>
                <p class="text-gray-600 mb-6">Submit your first prayer request using the form above.</p>
            </div>
        @endif
    </div>

    @if(auth()->user()->role !== 'admin')
        <!-- Testimonies Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">My Testimonies</h2>
            @if($testimonies->count() > 0)
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-blue-600 to-red-600">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Photo</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Location</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Testimony</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($testimonies as $testimony)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $testimony->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($testimony->photo)
                                                <img src="{{ asset('storage/' . $testimony->photo) }}" alt="{{ $testimony->name }}" class="w-12 h-12 rounded-full object-cover">
                                            @else
                                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-red-500 flex items-center justify-center text-white font-bold">
                                                    {{ substr($testimony->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $testimony->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $testimony->location ?? '-' }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-600 max-w-md">
                                            <div class="truncate">{{ Str::limit($testimony->testimony, 80) }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($testimony->is_approved)
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                                    Approved
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                                    Pending Approval
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($testimonies->hasPages())
                        <div class="px-6 py-4 border-t border-gray-200">
                            {{ $testimonies->links() }}
                        </div>
                    @endif
                </div>
            @else
                <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No Testimonies Yet</h3>
                    <p class="text-gray-600 mb-6">Share your testimony using the form above. It will be reviewed by admin before being published.</p>
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
