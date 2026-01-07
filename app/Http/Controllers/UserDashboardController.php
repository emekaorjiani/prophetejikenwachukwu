<?php

namespace App\Http\Controllers;

use App\Models\PrayerRequest;
use App\Models\Testimony;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserDashboardController extends Controller
{
    public function index()
    {
        $prayerRequests = PrayerRequest::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $testimonies = Testimony::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Visitor statistics (for admin)
        $visitorStats = null;
        if (auth()->user()->role === 'admin') {
            $visitorStats = [
                'total' => Visitor::count(),
                'active' => Visitor::where('is_active', true)->count(),
                'today' => Visitor::whereDate('created_at', today())->count(),
                'this_week' => Visitor::where('created_at', '>=', now()->startOfWeek())->count(),
                'this_month' => Visitor::where('created_at', '>=', now()->startOfMonth())->count(),
            ];
        }

        return view('dashboard.index', compact('prayerRequests', 'testimonies', 'visitorStats'));
    }

    public function storePrayerRequest(Request $request)
    {
        $request->validate([
            'country' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'request' => 'required|string|min:10',
        ]);

        PrayerRequest::create([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'phone' => $request->input('phone'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'request' => $request->input('request'),
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Your prayer request has been submitted successfully!');
    }

    public function storeTestimony(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'testimony' => 'required|string|min:20',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'testimony' => $request->testimony,
            'user_id' => auth()->id(),
            'is_approved' => false, // Requires admin approval
            'is_featured' => false,
            'order' => 0,
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonies', 'public');
        }

        Testimony::create($data);

        return redirect()->route('dashboard')->with('success', 'Your testimony has been submitted and is pending admin approval!');
    }
}
