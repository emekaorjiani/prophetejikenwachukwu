<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use App\Models\Testimony;
use App\Models\Video;
use App\Models\Visitor;
use App\Models\ContactMessage;
use App\Models\User;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Prayer Requests (existing)
    public function index()
    {
        $requests = PrayerRequest::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.index', compact('requests'));
    }

    public function download()
    {
        $requests = PrayerRequest::all();

        $csvData = [];
        $csvData[] = ['ID', 'Name', 'Email', 'Phone', 'Country', 'State', 'City', 'Address', 'Request', 'Status', 'Response', 'Platform', 'Created At'];

        foreach ($requests as $request) {
            $csvData[] = [
                $request->id,
                $request->name,
                $request->email,
                $request->phone ?? '',
                $request->country ?? '',
                $request->state ?? '',
                $request->city ?? '',
                $request->address ?? '',
                $request->request,
                $request->status,
                $request->response ?? '',
                $request->response_platform ?? '',
                $request->created_at->format('Y-m-d H:i:s'),
            ];
        }

        $filename = 'prayer_requests_' . date('Y-m-d_His') . '.csv';

        $handle = fopen('php://temp', 'r+');
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $content = stream_get_contents($handle);
        fclose($handle);

        return Response::make($content, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    public function prayerRequestEdit(PrayerRequest $prayerRequest)
    {
        return view('admin.prayer-request-form', compact('prayerRequest'));
    }

    public function update(Request $request, PrayerRequest $prayerRequest)
    {
        $request->validate([
            'response' => 'nullable|string',
            'response_platform' => 'nullable|in:youtube,facebook,tiktok,instagram',
            'status' => 'required|in:pending,responded',
        ]);

        $prayerRequest->update([
            'response' => $request->response,
            'response_platform' => $request->response_platform,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.index')->with('success', 'Prayer request updated successfully!');
    }

    // Testimonies Management
    public function testimonies()
    {
        $testimonies = Testimony::orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.testimonies', compact('testimonies'));
    }

    public function testimonyCreate()
    {
        return view('admin.testimony-form');
    }

    public function testimonyEdit(Testimony $testimony)
    {
        return view('admin.testimony-form', compact('testimony'));
    }

    public function testimonyShow(Testimony $testimony)
    {
        return response()->json($testimony);
    }

    public function testimonyStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'testimony' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        $data = $request->except(['photo']);
        $data['is_approved'] = true; // Admin-created testimonies are auto-approved
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonies', 'public');
        }

        Testimony::create($data);
        return redirect()->route('admin.testimonies')->with('success', 'Testimony added successfully!');
    }

    public function testimonyUpdate(Request $request, Testimony $testimony)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'testimony' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'is_approved' => 'boolean',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        $data = $request->except(['photo']);
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($testimony->photo) {
                \Storage::disk('public')->delete($testimony->photo);
            }
            $data['photo'] = $request->file('photo')->store('testimonies', 'public');
        }

        $testimony->update($data);
        return redirect()->route('admin.testimonies')->with('success', 'Testimony updated successfully!');
    }

    public function testimonyApprove(Testimony $testimony)
    {
        $testimony->update(['is_approved' => true]);
        return back()->with('success', 'Testimony approved successfully!');
    }

    public function testimonyReject(Testimony $testimony)
    {
        $testimony->update(['is_approved' => false]);
        return back()->with('success', 'Testimony rejected successfully!');
    }

    public function testimonyDestroy(Testimony $testimony)
    {
        $testimony->delete();
        return back()->with('success', 'Testimony deleted successfully!');
    }

    // Videos Management
    public function videos()
    {
        $videos = Video::orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.videos', compact('videos'));
    }

    public function videoCreate()
    {
        return view('admin.video-form');
    }

    public function videoEdit(Video $video)
    {
        return view('admin.video-form', compact('video'));
    }

    public function videoStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string',
            'video_file' => 'nullable|mimes:mp4,avi,mov,wmv,flv,webm|max:102400', // 100MB max
            'thumbnail' => 'nullable|image|max:2048',
            'platform' => 'required|in:youtube,facebook,tiktok,instagram,other',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        // Ensure at least one of video_url or video_file is provided
        if (!$request->hasFile('video_file') && !$request->filled('video_url')) {
            return back()->withErrors(['video_url' => 'Either video URL or video file is required.'])->withInput();
        }

        $data = $request->except(['video_file']);

        if ($request->hasFile('video_file')) {
            $data['video_file'] = $request->file('video_file')->store('videos', 'public');
            $data['video_url'] = null; // Clear URL if uploading file
            $data['platform'] = 'other'; // Set platform to other for uploaded videos
        } else {
            $data['video_file'] = null; // Clear file if using URL
        }

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos', 'public');
        }

        Video::create($data);
        return redirect()->route('admin.videos')->with('success', 'Video added successfully!');
    }

    public function videoUpdate(Request $request, Video $video)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'nullable|string',
            'video_file' => 'nullable|mimes:mp4,avi,mov,wmv,flv,webm|max:102400', // 100MB max
            'thumbnail' => 'nullable|image|max:2048',
            'platform' => 'required|in:youtube,facebook,tiktok,instagram,other',
            'is_featured' => 'boolean',
            'order' => 'integer',
        ]);

        // Ensure at least one of video_url or video_file exists
        if (!$request->hasFile('video_file') && !$request->filled('video_url') && !$video->video_file && !$video->video_url) {
            return back()->withErrors(['video_url' => 'Either video URL or video file is required.'])->withInput();
        }

        $data = $request->except(['video_file']);

        if ($request->hasFile('video_file')) {
            // Delete old video file if exists
            if ($video->video_file) {
                \Storage::disk('public')->delete($video->video_file);
            }
            $data['video_file'] = $request->file('video_file')->store('videos', 'public');
            $data['video_url'] = null; // Clear URL if uploading file
            $data['platform'] = 'other'; // Set platform to other for uploaded videos
        } elseif ($request->filled('video_url')) {
            // If URL is provided, clear video_file
            if ($video->video_file) {
                \Storage::disk('public')->delete($video->video_file);
            }
            $data['video_file'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($video->thumbnail) {
                \Storage::disk('public')->delete($video->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('videos', 'public');
        }

        $video->update($data);
        return redirect()->route('admin.videos')->with('success', 'Video updated successfully!');
    }

    public function videoDestroy(Video $video)
    {
        $video->delete();
        return back()->with('success', 'Video deleted successfully!');
    }

    // Visitors Management
    public function visitors()
    {
        $totalVisitors = Visitor::count();
        $activeVisitors = Visitor::where('is_active', true)->count();
        $todayVisitors = Visitor::whereDate('created_at', today())->count();
        $visitors = Visitor::orderBy('last_activity', 'desc')->paginate(50);

        return view('admin.visitors', compact('visitors', 'totalVisitors', 'activeVisitors', 'todayVisitors'));
    }

    // Contact Messages
    public function contacts()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.contacts', compact('messages'));
    }

    public function contactUpdate(Request $request, ContactMessage $contactMessage)
    {
        $request->validate([
            'status' => 'required|in:new,read,replied,archived',
            'admin_response' => 'nullable|string',
        ]);

        $contactMessage->update($request->all());
        return back()->with('success', 'Contact message updated successfully!');
    }

    public function contactDestroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return back()->with('success', 'Contact message deleted successfully!');
    }

    // Users Management
    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function userBan(Request $request, User $user)
    {
        $request->validate([
            'ban_reason' => 'required|string',
        ]);

        $user->update([
            'is_banned' => true,
            'ban_reason' => $request->ban_reason,
            'banned_at' => now(),
            'banned_by' => auth()->id(),
        ]);

        return back()->with('success', 'User banned successfully!');
    }

    public function userUnban(User $user)
    {
        $user->update([
            'is_banned' => false,
            'ban_reason' => null,
            'banned_at' => null,
            'banned_by' => null,
        ]);

        return back()->with('success', 'User unbanned successfully!');
    }

    public function userResetPassword(User $user)
    {
        $newPassword = Str::random(12);
        $user->update(['password' => Hash::make($newPassword)]);

        // Send email with new password
        Mail::raw("Your password has been reset. Your new password is: {$newPassword}", function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Password Reset - Rhema Deliverance Mission');
        });

        return back()->with('success', 'Password reset and email sent successfully!');
    }

    // Email Templates
    public function emailTemplates()
    {
        $templates = EmailTemplate::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.email-templates', compact('templates'));
    }

    public function emailTemplateCreate()
    {
        return view('admin.email-template-form');
    }

    public function emailTemplateEdit(EmailTemplate $emailTemplate)
    {
        return view('admin.email-template-form', compact('emailTemplate'));
    }

    public function emailTemplateStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'required|string',
            'is_active' => 'boolean',
        ]);

        EmailTemplate::create($request->all());
        return redirect()->route('admin.email-templates')->with('success', 'Email template created successfully!');
    }

    public function emailTemplateUpdate(Request $request, EmailTemplate $emailTemplate)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $emailTemplate->update($request->all());
        return redirect()->route('admin.email-templates')->with('success', 'Email template updated successfully!');
    }

    public function emailTemplateDestroy(EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();
        return back()->with('success', 'Email template deleted successfully!');
    }

    // Send Emails
    public function sendEmailForm()
    {
        $templates = EmailTemplate::where('is_active', true)->get();
        return view('admin.send-email', compact('templates'));
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'recipients' => 'required|in:users,contacts,all',
            'template_id' => 'nullable|exists:email_templates,id',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $recipients = [];

        if ($request->recipients === 'users' || $request->recipients === 'all') {
            $users = User::where('is_banned', false)->pluck('email');
            $recipients = array_merge($recipients, $users->toArray());
        }

        if ($request->recipients === 'contacts' || $request->recipients === 'all') {
            $contacts = ContactMessage::distinct('email')->pluck('email');
            $recipients = array_merge($recipients, $contacts->toArray());
        }

        $recipients = array_unique($recipients);
        $subject = $request->subject;
        $message = $request->message;

        // If template is selected, use it
        if ($request->template_id) {
            $template = EmailTemplate::findOrFail($request->template_id);
            $subject = $template->subject;
            $message = $template->body;
        }

        foreach ($recipients as $email) {
            // Get user or contact info for variable replacement
            $user = User::where('email', $email)->first();
            $contact = ContactMessage::where('email', $email)->first();

            $personalizedSubject = $subject;
            $personalizedMessage = $message;

            // Replace variables
            if ($user) {
                $personalizedSubject = str_replace('{name}', $user->name, $personalizedSubject);
                $personalizedMessage = str_replace('{name}', $user->name, $personalizedMessage);
                $personalizedMessage = str_replace('{email}', $user->email, $personalizedMessage);
            } elseif ($contact) {
                $personalizedSubject = str_replace('{name}', $contact->name, $personalizedSubject);
                $personalizedMessage = str_replace('{name}', $contact->name, $personalizedMessage);
                $personalizedMessage = str_replace('{email}', $contact->email, $personalizedMessage);
            } else {
                // Fallback if no user/contact found
                $personalizedSubject = str_replace('{name}', 'Friend', $personalizedSubject);
                $personalizedMessage = str_replace('{name}', 'Friend', $personalizedMessage);
                $personalizedMessage = str_replace('{email}', $email, $personalizedMessage);
            }

            // Replace password if it's a password reset (would need to be passed)
            if (isset($request->password)) {
                $personalizedMessage = str_replace('{password}', $request->password, $personalizedMessage);
            }

            Mail::raw($personalizedMessage, function ($mail) use ($email, $personalizedSubject) {
                $mail->to($email)->subject($personalizedSubject);
            });
        }

        return redirect()->route('admin.send-email')->with('success', 'Emails sent to ' . count($recipients) . ' recipients!');
    }
}
