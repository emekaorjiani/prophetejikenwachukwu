@extends('layouts.app')

@section('title', isset($emailTemplate) ? 'Edit Email Template' : 'Create Email Template')

@section('content')
@include('admin.nav')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                {{ isset($emailTemplate) ? 'Edit Email Template' : 'Create Email Template' }}
            </span>
        </h1>
        <p class="text-gray-600">
            <a href="{{ route('admin.email-templates') }}" class="text-blue-600 hover:text-blue-800">← Back to Templates</a>
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg p-8">
        <form action="{{ isset($emailTemplate) ? route('admin.email-templates.update', $emailTemplate) : route('admin.email-templates.store') }}" method="POST">
            @csrf
            @if(isset($emailTemplate))
                @method('PUT')
            @endif

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Template Name *</label>
                    <input type="text" name="name" value="{{ old('name', $emailTemplate->name ?? '') }}" required
                        class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Subject *</label>
                    <input type="text" name="subject" value="{{ old('subject', $emailTemplate->subject ?? '') }}" required
                        class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                    @error('subject')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Template Type *</label>
                    <select name="type" required
                        class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        <option value="general" {{ old('type', $emailTemplate->type ?? '') === 'general' ? 'selected' : '' }}>General</option>
                        <option value="welcome" {{ old('type', $emailTemplate->type ?? '') === 'welcome' ? 'selected' : '' }}>Welcome</option>
                        <option value="password_reset" {{ old('type', $emailTemplate->type ?? '') === 'password_reset' ? 'selected' : '' }}>Password Reset</option>
                        <option value="notification" {{ old('type', $emailTemplate->type ?? '') === 'notification' ? 'selected' : '' }}>Notification</option>
                        <option value="newsletter" {{ old('type', $emailTemplate->type ?? '') === 'newsletter' ? 'selected' : '' }}>Newsletter</option>
                    </select>
                    @error('type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Body *</label>
                    <textarea name="body" required rows="12"
                        class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('body', $emailTemplate->body ?? '') }}</textarea>
                    <p class="text-sm text-gray-500 mt-2">You can use variables like {name}, {email}, etc. in your template.</p>
                    @error('body')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                        {{ old('is_active', $emailTemplate->is_active ?? true) ? 'checked' : '' }}
                        class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="is_active" class="ml-2 text-sm font-semibold text-gray-700">Active</label>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 py-3 rounded-full bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold hover:from-blue-700 hover:to-red-700 transition-all">
                        {{ isset($emailTemplate) ? 'Update Template' : 'Create Template' }}
                    </button>
                    <a href="{{ route('admin.email-templates') }}" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-all flex items-center">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


