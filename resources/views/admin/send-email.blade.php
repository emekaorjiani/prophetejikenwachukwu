@extends('layouts.app')

@section('title', 'Admin - Send Email')

@section('content')
@include('admin.nav')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">
            <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">Send Email</span>
        </h1>
        <p class="text-gray-600">
            <a href="{{ route('admin.email-templates') }}" class="text-blue-600 hover:text-blue-800">← Back to Templates</a>
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-full">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg p-8">
        <form action="{{ route('admin.send-email.post') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Recipients *</label>
                    <select name="recipients" required id="recipients"
                        class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        <option value="users">All Users</option>
                        <option value="contacts">All Contacts</option>
                        <option value="all">All Users & Contacts</option>
                    </select>
                    @error('recipients')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Use Template (Optional)</label>
                    <select name="template_id" id="template_id"
                        class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                        <option value="">None - Custom Message</option>
                        @foreach($templates as $template)
                            <option value="{{ $template->id }}" 
                                data-subject="{{ htmlspecialchars($template->subject, ENT_QUOTES) }}" 
                                data-body="{{ htmlspecialchars($template->body, ENT_QUOTES) }}">
                                {{ $template->name }} ({{ ucfirst($template->type) }})
                            </option>
                        @endforeach
                    </select>
                    <p class="text-sm text-gray-500 mt-2">Selecting a template will auto-fill the subject and message fields. You can still edit them after selection.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Subject *</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required
                        class="w-full px-4 py-3 rounded-full border-2 border-gray-200 focus:border-blue-600 focus:outline-none">
                    @error('subject')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email Message *</label>
                    <textarea name="message" id="message" required rows="12"
                        class="w-full px-4 py-3 rounded-3xl border-2 border-gray-200 focus:border-blue-600 focus:outline-none resize-none">{{ old('message') }}</textarea>
                    <p class="text-sm text-gray-500 mt-2">You can use variables like {name}, {email}, etc. in your message.</p>
                    @error('message')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded-lg">
                    <p class="text-sm text-yellow-800">
                        <strong>Warning:</strong> Sending emails to all recipients may take some time. Please be patient and do not refresh the page.
                    </p>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 py-3 rounded-full bg-green-600 text-white font-semibold hover:bg-green-700 transition-all">
                        Send Email
                    </button>
                    <a href="{{ route('admin.email-templates') }}" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300 transition-all flex items-center">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('template_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    if (selectedOption.value && selectedOption.dataset.subject) {
        document.getElementById('subject').value = selectedOption.dataset.subject || '';
        document.getElementById('message').value = selectedOption.dataset.body || '';
    } else if (!selectedOption.value) {
        // Clear fields if "None" is selected
        document.getElementById('subject').value = '';
        document.getElementById('message').value = '';
    }
});
</script>
@endsection

