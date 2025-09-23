<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZonalOffice;

class ZonalOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zonalOffices = ZonalOffice::latest()->paginate(10);
        return view('admin.zonal-offices.index', compact('zonalOffices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.zonal-offices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'states_covered' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
        ]);

        ZonalOffice::create($validated);

        return redirect()->route('admin.zonal-offices.index')->with('success', 'Zonal office created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $zonalOffice = ZonalOffice::findOrFail($id);
        return view('admin.zonal-offices.edit', compact('zonalOffice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'states_covered' => 'required|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'description' => 'nullable|string',
        ]);

        $zonalOffice = ZonalOffice::findOrFail($id);
        $zonalOffice->update($validated);

        return redirect()->route('admin.zonal-offices.index')->with('success', 'Zonal office updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $zonalOffice = ZonalOffice::findOrFail($id);
        $zonalOffice->delete();

        return redirect()->route('admin.zonal-offices.index')->with('success', 'Zonal office deleted successfully.');
    }
}
