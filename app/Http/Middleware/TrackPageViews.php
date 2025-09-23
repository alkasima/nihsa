<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use App\Services\AnalyticsService;

class TrackPageViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track GET requests and successful responses (status 200-399)
        if ($request->method() === 'GET' && $response->getStatusCode() < 400) {
            $this->trackPageView($request);
        }

        return $response;
    }

    /**
     * Track the page view
     */
    private function trackPageView(Request $request)
    {
        try {
            // Skip tracking for admin routes, API routes, and asset files
            if ($this->shouldSkipTracking($request)) {
                return;
            }

            // Check if analytics tables exist before tracking
            if (!$this->analyticsTablesExist()) {
                return;
            }

            $analyticsService = new AnalyticsService();
            $url = $request->fullUrl();
            $title = $this->extractPageTitle($request);

            // Track the page view
            $analyticsService->trackPageView($request, $url, $title);

        } catch (\Exception $e) {
            // Log error but don't break the request
            Log::error('Analytics tracking failed: ' . $e->getMessage());
        }
    }

    /**
     * Check if analytics tables exist
     */
    private function analyticsTablesExist()
    {
        try {
            return Schema::hasTable('user_sessions') &&
                   Schema::hasTable('page_views') &&
                   Schema::hasTable('traffic_sources');
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Determine if tracking should be skipped
     */
    private function shouldSkipTracking(Request $request): bool
    {
        $skipPatterns = [
            '/admin/*',
            '/api/*',
            '/_debugbar/*',
            '*.css',
            '*.js',
            '*.png',
            '*.jpg',
            '*.jpeg',
            '*.gif',
            '*.svg',
            '*.ico',
            '*.woff',
            '*.woff2',
            '*.ttf',
            '*.eot',
            '*/storage/*',
            '*/vendor/*',
        ];

        $path = $request->path();

        foreach ($skipPatterns as $pattern) {
            if (fnmatch($pattern, $path)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Extract page title from request
     */
    private function extractPageTitle(Request $request): ?string
    {
        // Try to get title from route name
        $routeName = $request->route()?->getName();
        if ($routeName) {
            // Convert route name to readable title
            return ucwords(str_replace(['.', '-', '_'], ' ', $routeName));
        }

        // Fallback to URL path
        $path = $request->path();
        if ($path === '/' || empty($path)) {
            return 'Home';
        }

        return ucwords(str_replace(['/', '-', '_'], ' ', $path));
    }
}
