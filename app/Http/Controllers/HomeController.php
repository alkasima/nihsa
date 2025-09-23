<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Publication;
use App\Models\Partner;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Remove auth middleware for public pages
        // $this->middleware('auth');
    }

    /**
     * Show the application homepage.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch real data from the database
        $latestNews = News::whereNotNull('published_at')
                         ->orderBy('published_at', 'desc')
                         ->take(3)
                         ->get();

        $featuredPublications = Publication::where('is_featured', true)
                                          ->orderBy('created_at', 'desc')
                                          ->take(4)
                                          ->get();

        $partners = Partner::orderBy('display_order')
                          ->take(6)
                          ->get();

        return view('home', compact('latestNews', 'featuredPublications', 'partners'));
    }

    /**
     * Search for content across the site.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        // In a real implementation, we would search the database
        // $news = News::where('title', 'like', "%{$query}%")
        //     ->orWhere('content', 'like', "%{$query}%")
        //     ->get();
        // $publications = Publication::where('title', 'like', "%{$query}%")
        //     ->orWhere('description', 'like', "%{$query}%")
        //     ->get();

        // For now, we'll create some dummy search results
        $results = [];

        if ($query) {
            // Dummy news results
            $results[] = [
                'type' => 'News',
                'title' => '2025 Annual Flood Outlook Released',
                'description' => 'NIHSA has released the 2025 Annual Flood Outlook (AFO) with predictions for the rainy season.',
                'url' => '#',
                'date' => '2025-05-05'
            ];

            $results[] = [
                'type' => 'Publication',
                'title' => 'Flood Mitigation & Adaptation Measures',
                'description' => 'Guidelines for flood mitigation and adaptation strategies.',
                'url' => '#',
                'date' => '2025-04-15'
            ];

            $results[] = [
                'type' => 'Page',
                'title' => 'About NIHSA',
                'description' => 'Information about the Nigeria Hydrological Services Agency.',
                'url' => route('about'),
                'date' => null
            ];
        }

        return view('search', compact('query', 'results'));
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // This method requires authentication
        $this->middleware('auth');

        // Fetch real data from the database
        $newsCount = News::count();
        $publicationsCount = Publication::count();
        $dataRequestsCount = \App\Models\DataRequest::count();
        $pendingDataRequestsCount = \App\Models\DataRequest::where('status', 'pending')->count();
        $floodDataCount = \App\Models\FloodData::count();
        $zonalOfficesCount = \App\Models\ZonalOffice::count();
        $partnersCount = \App\Models\Partner::count();

        $latestNews = News::orderBy('published_at', 'desc')->take(5)->get();
        $latestDataRequests = \App\Models\DataRequest::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'newsCount',
            'publicationsCount',
            'dataRequestsCount',
            'pendingDataRequestsCount',
            'floodDataCount',
            'zonalOfficesCount',
            'partnersCount',
            'latestNews',
            'latestDataRequests'
        ));
    }
}
