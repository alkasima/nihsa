<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource (Public).
     */
    public function index()
    {
        // Fetch paginated publications from database (most recent first)
        $publications = Publication::orderBy('publication_date', 'desc')->paginate(12);

        // Group the current page of publications by type for sidebar display
        $publicationsByType = [];
        foreach ($publications->items() as $item) {
            $publicationsByType[$item->type][] = $item;
        }

        // Get all distinct years
        $years = Publication::select('year')->distinct()->orderBy('year', 'desc')->pluck('year')->toArray();

        // Get all distinct types
        $types = Publication::select('type')->distinct()->orderBy('type')->pluck('type')->toArray();

        return view('publications.index', compact('publications', 'publicationsByType', 'years', 'types'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function adminIndex()
    {
        // Start with base query
        $query = Publication::query();

        // Apply search filter
        if (request('search')) {
            $searchTerm = request('search');
            $query->where('title', 'like', '%' . $searchTerm . '%');
        }

        // Apply type filter
        if (request('type')) {
            $query->where('type', request('type'));
        }

        // Apply year filter
        if (request('year')) {
            $query->where('year', request('year'));
        }

        // Apply featured filter
        if (request('featured') !== null && request('featured') !== '') {
            $query->where('is_featured', request('featured'));
        }

        // Order by publication date (most recent first) and paginate
        $publications = $query->orderBy('publication_date', 'desc')->paginate(20)->withQueryString();

        return view('admin.publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method is for admin use only
        $this->middleware('auth');

        return view('admin.publications.create');
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
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip|max:10240',
            'type' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'publication_date' => 'required|date',
            'is_featured' => 'boolean',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('publications', 'public');
        }

        $publication = Publication::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'type' => $validated['type'],
            'year' => $validated['year'],
            'publication_date' => $validated['publication_date'],
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.publications.index')->with('success', 'Publication created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publication = Publication::findOrFail($id);

        // Get related publications (same type, excluding current publication)
        $relatedPublications = Publication::where('type', $publication->type)
                                        ->where('id', '!=', $publication->id)
                                        ->orderBy('publication_date', 'desc')
                                        ->take(4)
                                        ->get();

        return view('publications.show', compact('publication', 'relatedPublications'));
    }

    /**
     * Download a publication file.
     */
    public function download(string $id)
    {
        $publication = Publication::findOrFail($id);

        if ($publication->file_path && Storage::disk('public')->exists($publication->file_path)) {
            return Storage::disk('public')->download($publication->file_path, $publication->title . '.' . pathinfo($publication->file_path, PATHINFO_EXTENSION));
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $publication = Publication::findOrFail($id);
        return view('admin.publications.edit', compact('publication'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip|max:10240',
            'type' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'publication_date' => 'required|date',
            'is_featured' => 'boolean',
        ]);

        $publication = Publication::findOrFail($id);

        $publication->title = $validated['title'];
        $publication->description = $validated['description'];
        $publication->type = $validated['type'];
        $publication->year = $validated['year'];
        $publication->publication_date = $validated['publication_date'];
        $publication->is_featured = $request->has('is_featured');

        if ($request->hasFile('file')) {
            // Delete old file
            if ($publication->file_path) {
                Storage::disk('public')->delete($publication->file_path);
            }

            // Store new file
            $publication->file_path = $request->file('file')->store('publications', 'public');
        }

        $publication->save();

        return redirect()->route('admin.publications.index')->with('success', 'Publication updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $publication = Publication::findOrFail($id);

        // Delete the file
        if ($publication->file_path) {
            Storage::disk('public')->delete($publication->file_path);
        }

        // Delete the record
        $publication->delete();

        return redirect()->route('admin.publications.index')->with('success', 'Publication deleted successfully.');
    }
}
