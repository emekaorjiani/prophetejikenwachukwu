<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        $url = $request->fullUrl();
        $referer = $request->header('referer');

        // Update or create visitor
        $visitor = Visitor::firstOrNew(['ip_address' => $ip]);
        
        if ($visitor->exists) {
            $visitor->visit_count++;
        }
        
        $visitor->user_agent = $userAgent;
        $visitor->url = $url;
        $visitor->referer = $referer;
        $visitor->last_activity = now();
        $visitor->is_active = true;
        $visitor->save();

        // Mark old visitors as inactive (older than 15 minutes)
        Visitor::where('last_activity', '<', now()->subMinutes(15))
            ->update(['is_active' => false]);

        return $next($request);
    }
}
