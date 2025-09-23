<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource (Public).
     */
    public function index()
    {
        // Fetch paginated news from database (most recent first)
        $news = News::orderBy('published_at', 'desc')->paginate(9);

        // Group the current page of news by category for sidebar display
        $newsByCategory = [];
        foreach ($news->items() as $item) {
            $newsByCategory[$item->category][] = $item;
        }

        // Get all distinct categories
        $categories = News::select('category')->distinct()->orderBy('category')->pluck('category')->toArray();

        return view('news.index', compact('news', 'newsByCategory', 'categories'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function adminIndex()
    {
        // Start with base query
        $query = News::query();

        // Apply search filter
        if (request('search')) {
            $searchTerm = request('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('content', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply category filter
        if (request('category')) {
            $query->where('category', request('category'));
        }

        // Apply date range filter
        if (request('date_range')) {
            $dateRange = request('date_range');
            switch ($dateRange) {
                case 'today':
                    $query->whereDate('published_at', today());
                    break;
                case 'week':
                    $query->whereBetween('published_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('published_at', now()->month)
                          ->whereYear('published_at', now()->year);
                    break;
                case 'year':
                    $query->whereYear('published_at', now()->year);
                    break;
            }
        }

        // Order by published date (most recent first) and paginate
        $news = $query->orderBy('published_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method is for admin use only
    $this->middleware('auth');

    return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news', 'public');
        }

        $news = News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'category' => $validated['category'],
            'is_featured' => !empty($validated['is_featured']),
            'published_at' => $validated['published_at'] ?? now(),
            'user_id' => Auth::id() ?? 1,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'News created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $newsItem = News::with('user')->findOrFail($id);

        // Related news: same category, exclude current
        $relatedNews = News::where('id', '!=', $id)
            ->where('category', $newsItem->category)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('news.show', compact('newsItem', 'relatedNews'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

    $newsItem = News::findOrFail($id);
    return view('admin.news.edit', compact('newsItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        // If published_at is present but empty string (from quick publish/unpublish forms), normalize to null
        if ($request->has('published_at') && $request->published_at === '') {
            $request->merge(['published_at' => null]);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|string|max:255',
            'is_featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $newsItem = News::findOrFail($id);

        $newsItem->title = $validated['title'];
        $newsItem->content = $validated['content'];
        $newsItem->category = $validated['category'];
        $newsItem->is_featured = !empty($validated['is_featured']);
        $newsItem->published_at = $validated['published_at'] ?? $newsItem->published_at;

        if ($request->hasFile('image')) {
            // Delete old image
            if ($newsItem->image) {
                Storage::disk('public')->delete($newsItem->image);
            }

            // Store new image
            $newsItem->image = $request->file('image')->store('news', 'public');
        }

        // If the admin requested to remove the current image
        if ($request->has('remove_image') && $request->remove_image) {
            if ($newsItem->image) {
                Storage::disk('public')->delete($newsItem->image);
            }
            $newsItem->image = null;
        }

        $newsItem->save();

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $newsItem = News::findOrFail($id);

        // Delete image if exists
        if ($newsItem->image) {
            Storage::disk('public')->delete($newsItem->image);
        }

        $newsItem->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
