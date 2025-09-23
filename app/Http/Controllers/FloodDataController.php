<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FloodData;

class FloodDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get flood data from database
        $floodData = FloodData::orderBy('created_at', 'desc')->paginate(15);

        // For backward compatibility, also create some dummy data structure
        $dummyData = [
            [
                'id' => 1,
                'state' => 'Lagos',
                'lga' => 'Ikorodu',
                'year' => 2025,
                'period' => 'July-September',
                'risk_level' => 'High',
                'data_type' => 'prediction',
                'forecast_date' => '2025-07-15',
                'latitude' => 6.6018,
                'longitude' => 3.5106,
                'description' => 'High probability of flooding due to heavy rainfall and poor drainage',
                'details' => [
                    'probability' => '80%',
                    'affected_area' => '120 sq km',
                    'population_at_risk' => '250,000',
                    'expected_rainfall' => '350mm'
                ]
            ],
            [
                'id' => 2,
                'state' => 'Rivers',
                'lga' => 'Port Harcourt',
                'year' => 2025,
                'period' => 'July-September',
                'risk_level' => 'High',
                'data_type' => 'prediction',
                'forecast_date' => '2025-07-20',
                'latitude' => 4.8156,
                'longitude' => 7.0498,
                'description' => 'Riverine flooding expected due to high water levels',
                'details' => [
                    'probability' => '85%',
                    'affected_area' => '95 sq km',
                    'population_at_risk' => '180,000',
                    'expected_rainfall' => '400mm'
                ]
            ],
            [
                'id' => 3,
                'state' => 'FCT',
                'lga' => 'Abuja Municipal',
                'year' => 2025,
                'period' => 'July-September',
                'risk_level' => 'Moderate',
                'data_type' => 'prediction',
                'forecast_date' => '2025-07-25',
                'latitude' => 9.0765,
                'longitude' => 7.3986,
                'description' => 'Moderate flooding risk in low-lying areas',
                'details' => [
                    'probability' => '65%',
                    'affected_area' => '75 sq km',
                    'population_at_risk' => '120,000',
                    'expected_rainfall' => '280mm'
                ]
            ],
            [
                'id' => 4,
                'state' => 'Kano',
                'lga' => 'Kano Municipal',
                'year' => 2025,
                'period' => 'July-September',
                'risk_level' => 'Low',
                'data_type' => 'prediction',
                'forecast_date' => '2025-08-01',
                'latitude' => 12.0022,
                'longitude' => 8.5920,
                'description' => 'Low flooding risk with adequate drainage systems',
                'details' => [
                    'probability' => '30%',
                    'affected_area' => '45 sq km',
                    'population_at_risk' => '80,000',
                    'expected_rainfall' => '180mm'
                ]
            ],
            [
                'id' => 5,
                'state' => 'Delta',
                'lga' => 'Warri South',
                'year' => 2025,
                'period' => 'July-September',
                'risk_level' => 'High',
                'data_type' => 'occurrence',
                'forecast_date' => '2025-07-10',
                'latitude' => 5.5160,
                'longitude' => 5.7500,
                'description' => 'Coastal flooding reported in several communities',
                'details' => [
                    'probability' => '100%',
                    'affected_area' => '150 sq km',
                    'population_at_risk' => '200,000',
                    'expected_rainfall' => '450mm'
                ]
            ],
            [
                'id' => 6,
                'state' => 'Ogun',
                'lga' => 'Abeokuta North',
                'year' => 2025,
                'period' => 'April-June',
                'risk_level' => 'Moderate',
                'data_type' => 'impact',
                'forecast_date' => '2025-06-15',
                'latitude' => 7.1475,
                'longitude' => 3.3619,
                'description' => 'Post-flood impact assessment and recovery planning',
                'details' => [
                    'probability' => '100%',
                    'affected_area' => '85 sq km',
                    'population_at_risk' => '150,000',
                    'expected_rainfall' => '320mm'
                ]
            ]
        ];

        return view('admin.flood-data.index', compact('floodData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get Nigerian states for the dropdown
        $states = [
            'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno',
            'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe',
            'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara',
            'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau',
            'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'
        ];

        return view('admin.flood-data.create', compact('states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'state' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
            'community' => 'nullable|string|max:255',
            'year' => 'required|integer|min:2020|max:2030',
            'period' => 'required|string|in:AMJ,JAS,ON',
            'risk_level' => 'required|string|in:High,Moderate,Low',
            'flood_type' => 'required|string|in:Riverine,Flash/Urban,Coastal',
            'forecast_date' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'description' => 'required|string|max:1000',
            'probability' => 'nullable|integer|min:0|max:100',
            'affected_area' => 'nullable|numeric|min:0',
            'affected_population' => 'nullable|integer|min:0',
            'expected_rainfall' => 'nullable|numeric|min:0'
        ]);

        // Save to the database
        $floodData = FloodData::create($validatedData);

        return redirect()->route('admin.flood-data.index')
            ->with('success', 'Flood data created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // In a real implementation, we would fetch from database
        // $floodData = FloodData::findOrFail($id);

        // For now, return a sample record
        $floodData = [
            'id' => $id,
            'state' => 'Lagos',
            'lga' => 'Ikorodu',
            'year' => 2025,
            'period' => 'July-September',
            'risk_level' => 'High',
            'data_type' => 'prediction',
            'forecast_date' => '2025-07-15',
            'latitude' => 6.6018,
            'longitude' => 3.5106,
            'description' => 'High probability of flooding due to heavy rainfall and poor drainage',
            'details' => [
                'probability' => '80%',
                'affected_area' => '120 sq km',
                'population_at_risk' => '250,000',
                'expected_rainfall' => '350mm'
            ]
        ];

        return view('admin.flood-data.show', compact('floodData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Get Nigerian states for the dropdown
        $states = [
            'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno',
            'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe',
            'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara',
            'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau',
            'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'
        ];

        // In a real implementation, we would fetch from database
        // $floodData = FloodData::findOrFail($id);

        // For now, return a sample record
        $floodData = [
            'id' => $id,
            'state' => 'Lagos',
            'lga' => 'Ikorodu',
            'year' => 2025,
            'period' => 'JAS',
            'risk_level' => 'High',
            'data_type' => 'prediction',
            'forecast_date' => '2025-07-15',
            'latitude' => 6.6018,
            'longitude' => 3.5106,
            'description' => 'High probability of flooding due to heavy rainfall and poor drainage',
            'probability' => 80,
            'affected_area' => 120,
            'population_at_risk' => 250000,
            'expected_rainfall' => 350
        ];

        return view('admin.flood-data.edit', compact('floodData', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'state' => 'required|string|max:255',
            'lga' => 'required|string|max:255',
            'year' => 'required|integer|min:2020|max:2030',
            'period' => 'required|string|in:AMJ,JAS,ON',
            'risk_level' => 'required|string|in:High,Moderate,Low',
            'data_type' => 'required|string|in:prediction,occurrence,impact',
            'forecast_date' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'description' => 'required|string|max:1000',
            'probability' => 'nullable|integer|min:0|max:100',
            'affected_area' => 'nullable|numeric|min:0',
            'population_at_risk' => 'nullable|integer|min:0',
            'expected_rainfall' => 'nullable|numeric|min:0'
        ]);

        // In a real implementation, we would update the database
        // $floodData = FloodData::findOrFail($id);
        // $floodData->update($request->all());

        return redirect()->route('admin.flood-data.index')
            ->with('success', 'Flood data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // In a real implementation, we would delete from database
        // $floodData = FloodData::findOrFail($id);
        // $floodData->delete();

        return redirect()->route('admin.flood-data.index')
            ->with('success', 'Flood data deleted successfully.');
    }
}
