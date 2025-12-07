<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procurement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProcurementController extends Controller
{
    /**
     * Display a listing of the resource (Public).
     */
    public function index()
    {
        // Fetch paginated procurements from database (most recent first)
        $procurements = Procurement::orderBy('publication_date', 'desc')->paginate(12);

        // Group ALL procurements by type for proper display (not just current page)
        $allProcurements = Procurement::orderBy('publication_date', 'desc')->get();
        $procurementsByType = [];
        foreach ($allProcurements as $item) {
            $procurementsByType[$item->type][] = $item;
        }

        // Get all distinct years
        $years = Procurement::select('year')->distinct()->orderBy('year', 'desc')->pluck('year')->toArray();

        // Get all distinct types
        $types = Procurement::select('type')->distinct()->orderBy('type')->pluck('type')->toArray();

        // Debug information
        Log::info('Procurements Debug', [
            'total_procurements' => $procurements->total(),
            'current_page_count' => $procurements->count(),
            'all_procurements_count' => $allProcurements->count(),
            'procurements_by_type' => $procurementsByType,
            'types' => $types,
            'years' => $years
        ]);

        return view('procurements.index', compact('procurements', 'procurementsByType', 'years', 'types'));
    }

    /**
     * Display a listing of the resource (Admin).
     */
    public function adminIndex()
    {
        // Start with base query
        $query = Procurement::query();

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
        $procurements = $query->orderBy('publication_date', 'desc')->paginate(20)->withQueryString();

        return view('admin.procurements.index', compact('procurements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method is for admin use only
        $this->middleware('auth');

        return view('admin.procurements.create');
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
            $filePath = $request->file('file')->store('procurements', 'public');
        }

        $procurement = Procurement::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'file_path' => $filePath,
            'type' => $validated['type'],
            'year' => $validated['year'],
            'publication_date' => $validated['publication_date'],
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.procurements.index')->with('success', 'Procurement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $procurement = Procurement::findOrFail($id);

        // Get related procurements (same type, excluding current procurement)
        $relatedProcurements = Procurement::where('type', $procurement->type)
                                        ->where('id', '!=', $procurement->id)
                                        ->orderBy('publication_date', 'desc')
                                        ->take(4)
                                        ->get();

        return view('procurements.show', compact('procurement', 'relatedProcurements'));
    }

    /**
     * Download a procurement file.
     */
    public function download(string $id)
    {
        $procurement = Procurement::findOrFail($id);

        if ($procurement->file_path && Storage::disk('public')->exists($procurement->file_path)) {
            return Storage::disk('public')->download($procurement->file_path, $procurement->title . '.' . pathinfo($procurement->file_path, PATHINFO_EXTENSION));
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

        $procurement = Procurement::findOrFail($id);
        return view('admin.procurements.edit', compact('procurement'));
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

        $procurement = Procurement::findOrFail($id);

        $procurement->title = $validated['title'];
        $procurement->description = $validated['description'];
        $procurement->type = $validated['type'];
        $procurement->year = $validated['year'];
        $procurement->publication_date = $validated['publication_date'];
        $procurement->is_featured = $request->has('is_featured');

        if ($request->hasFile('file')) {
            // Delete old file
            if ($procurement->file_path) {
                Storage::disk('public')->delete($procurement->file_path);
            }

            // Store new file
            $procurement->file_path = $request->file('file')->store('procurements', 'public');
        }

        $procurement->save();

        return redirect()->route('admin.procurements.index')->with('success', 'Procurement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $procurement = Procurement::findOrFail($id);

        // Delete the file
        if ($procurement->file_path) {
            Storage::disk('public')->delete($procurement->file_path);
        }

        // Delete the record
        $procurement->delete();

        return redirect()->route('admin.procurements.index')->with('success', 'Procurement deleted successfully.');
    }
}
