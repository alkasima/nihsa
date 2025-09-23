<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataRequest;
use Illuminate\Support\Facades\Auth;

class DataRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // This method is for admin use only
        $this->middleware('auth');

        $dataRequests = DataRequest::latest()->paginate(10);
        return view('admin.data-requests.index', compact('dataRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data-request.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'organization' => 'nullable|string|max:255',
            'data_type' => 'required|string|max:255',
            'description' => 'required|string',
            'time_period' => 'nullable|string|max:255',
            'geographic_area' => 'nullable|string|max:255',
            'data_format' => 'nullable|string|max:50',
            'additional_info' => 'nullable|string',
        ]);

        $dataRequest = DataRequest::create($validated);

        return redirect()->route('data-request.success')->with('success', 'Your data request has been submitted successfully.');
    }

    /**
     * Display the success page after submitting a data request.
     */
    public function success()
    {
        return view('data-request.success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $dataRequest = DataRequest::findOrFail($id);
        return view('admin.data-requests.show', compact('dataRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $dataRequest = DataRequest::findOrFail($id);
        return view('admin.data-requests.edit', compact('dataRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $validated = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected,delivered',
            'admin_notes' => 'nullable|string',
        ]);

        $dataRequest = DataRequest::findOrFail($id);
        $dataRequest->update($validated);

        return redirect()->route('admin.data-requests.index')->with('success', 'Data request updated successfully.');
    }

    /**
     * Approve a data request.
     */
    public function approve(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $dataRequest = DataRequest::findOrFail($id);
        $dataRequest->status = 'approved';
        $dataRequest->processed_at = now();
        $dataRequest->save();

        // In a real implementation, we would send an email notification to the user

        return redirect()->route('admin.data-requests.index')->with('success', 'Data request approved successfully.');
    }

    /**
     * Reject a data request.
     */
    public function reject(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $dataRequest = DataRequest::findOrFail($id);
        $dataRequest->status = 'rejected';
        $dataRequest->processed_at = now();
        $dataRequest->save();

        // In a real implementation, we would send an email notification to the user

        return redirect()->route('admin.data-requests.index')->with('success', 'Data request rejected successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // This method is for admin use only
        $this->middleware('auth');

        $dataRequest = DataRequest::findOrFail($id);
        $dataRequest->delete();

        return redirect()->route('admin.data-requests.index')->with('success', 'Data request deleted successfully.');
    }
}
