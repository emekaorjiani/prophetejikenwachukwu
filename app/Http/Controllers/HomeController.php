<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $testimonies = Testimony::where('is_approved', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        $videos = Video::where('is_featured', true)
            ->orderBy('order')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('home', compact('testimonies', 'videos'));
    }
}
