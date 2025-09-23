<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FloodData;
use Carbon\Carbon;

class FloodForecastDashboardController extends Controller
{
    /**
     * Display the flood forecast dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Get filter parameters
        $year = $request->input('year', date('Y'));
        $period = $request->input('period', 'all');
        $state = $request->input('state', 'all');
        $riskLevel = $request->input('risk_level', 'all');
        $floodType = $request->input('flood_type', 'all');
        $adminLevel = $request->input('admin_level', 'all');

        // Get available years, states, and other filter options
        $availableYears = range(2020, 2030);
        $nigerianStates = $this->getNigerianStates();
        $periods = [
            'AMJ' => 'April-May-June',
            'JAS' => 'July-August-September',
            'ON' => 'October-November'
        ];
        $riskLevels = ['High', 'Moderate', 'Low'];
        $floodTypes = ['Riverine', 'Flash/Urban', 'Coastal'];
        $adminLevels = ['National', 'State', 'LGA', 'Community'];

        // Get flood data from database
        $floodData = $this->getFloodData($year, $period, $state, $riskLevel, $floodType, $adminLevel);

        // Generate statistics
        $statistics = $this->generateStatistics($floodData);

        // Generate community alerts data
        $communityAlerts = $this->generateCommunityAlerts($floodData);

        // Generate sensor data
        $sensorData = $this->generateSensorData();

        // Generate forecast data for temporal forecasting
        $forecastData = $this->generateForecastData();

        return view('flood-forecast-dashboard.index', compact(
            'floodData',
            'statistics',
            'communityAlerts',
            'sensorData',
            'forecastData',
            'availableYears',
            'nigerianStates',
            'periods',
            'riskLevels',
            'floodTypes',
            'adminLevels',
            'year',
            'period',
            'state',
            'riskLevel',
            'floodType',
            'adminLevel'
        ));
    }

    /**
     * Get API data for AJAX requests
     */
    public function apiData(Request $request)
    {
        $type = $request->input('type');

        switch($type) {
            case 'flood_data':
                return response()->json($this->getFloodData(
                    $request->input('year', date('Y')),
                    $request->input('period', 'all'),
                    $request->input('state', 'all'),
                    $request->input('risk_level', 'all'),
                    $request->input('flood_type', 'all'),
                    $request->input('admin_level', 'all')
                ));

            case 'sensor_data':
                return response()->json($this->generateSensorData());

            case 'forecast_data':
                return response()->json($this->generateForecastData());

            case 'community_alerts':
                return response()->json($this->generateCommunityAlerts());

            default:
                return response()->json(['error' => 'Invalid data type'], 400);
        }
    }

    /**
     * Export data in various formats
     */
    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $dataType = $request->input('data_type', 'flood_data');

        // Generate data based on current filters
        $data = $this->generateSampleFloodData(
            $request->input('year', date('Y')),
            $request->input('period', 'all'),
            $request->input('state', 'all'),
            $request->input('risk_level', 'all')
        );

        switch($format) {
            case 'csv':
                return $this->exportToCsv($data);
            case 'geojson':
                return $this->exportToGeoJson($data);
            case 'pdf':
                return $this->exportToPdf($data);
            default:
                return response()->json(['error' => 'Invalid export format'], 400);
        }
    }

    private function getNigerianStates()
    {
        return [
            'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno',
            'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'FCT', 'Gombe',
            'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara',
            'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau',
            'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara'
        ];
    }

    /**
     * Get flood data from database with filters
     */
    private function getFloodData($year, $period, $state, $riskLevel, $floodType, $adminLevel)
    {
        $query = FloodData::query();

        // Apply filters
        $query->byYear($year)
              ->byPeriod($period)
              ->byState($state)
              ->byRiskLevel($riskLevel)
              ->byFloodType($floodType);

        $floodData = $query->get();

        // Transform data for frontend
        return $floodData->map(function ($item) {
            return [
                'id' => $item->id,
                'lat' => (float) $item->latitude,
                'lng' => (float) $item->longitude,
                'risk' => $item->risk_level,
                'state' => $item->state,
                'lga' => $item->lga,
                'community' => $item->community ?? $item->lga,
                'flood_type' => $item->flood_type,
                'description' => $item->description,
                'probability' => $item->probability ?? 50,
                'affected_population' => $item->affected_population ?? 0,
                'affected_area' => $item->affected_area ?? 0,
                'expected_rainfall' => $item->expected_rainfall ?? 0,
                'year' => $item->year,
                'period' => $item->period
            ];
        })->toArray();
    }

    private function generateSampleFloodData($year, $period, $state, $riskLevel)
    {
        $floodData = [
            [
                'id' => 1,
                'lat' => 9.0765,
                'lng' => 7.3986,
                'risk' => 'High',
                'state' => 'FCT',
                'lga' => 'Abuja Municipal',
                'community' => 'Garki',
                'flood_type' => 'Flash/Urban',
                'description' => 'High risk of flooding in Abuja Municipal Area Council',
                'probability' => 85,
                'affected_population' => 150000,
                'affected_area' => 45.5,
                'expected_rainfall' => 250,
                'year' => 2025,
                'period' => 'JAS'
            ],
            [
                'id' => 2,
                'lat' => 6.5244,
                'lng' => 3.3792,
                'risk' => 'High',
                'state' => 'Lagos',
                'lga' => 'Lagos Island',
                'community' => 'Victoria Island',
                'flood_type' => 'Coastal',
                'description' => 'High risk of coastal flooding in Lagos Island',
                'probability' => 90,
                'affected_population' => 200000,
                'affected_area' => 25.3,
                'expected_rainfall' => 300,
                'year' => 2025,
                'period' => 'JAS'
            ],
            [
                'id' => 3,
                'lat' => 6.4698,
                'lng' => 3.5852,
                'risk' => 'Moderate',
                'state' => 'Lagos',
                'lga' => 'Lekki',
                'community' => 'Ajah',
                'flood_type' => 'Flash/Urban',
                'description' => 'Moderate risk of flooding in Lekki',
                'probability' => 65,
                'affected_population' => 80000,
                'affected_area' => 15.2,
                'expected_rainfall' => 200,
                'year' => 2025,
                'period' => 'AMJ'
            ],
            [
                'id' => 4,
                'lat' => 7.3775,
                'lng' => 3.9470,
                'risk' => 'Low',
                'state' => 'Oyo',
                'lga' => 'Ibadan North',
                'community' => 'Bodija',
                'flood_type' => 'Riverine',
                'description' => 'Low risk of riverine flooding in Ibadan North',
                'probability' => 35,
                'affected_population' => 45000,
                'affected_area' => 8.7,
                'expected_rainfall' => 150,
                'year' => 2025,
                'period' => 'ON'
            ],
            [
                'id' => 5,
                'lat' => 4.8156,
                'lng' => 7.0498,
                'risk' => 'High',
                'state' => 'Rivers',
                'lga' => 'Port Harcourt',
                'community' => 'Mile 1',
                'flood_type' => 'Riverine',
                'description' => 'High risk of riverine flooding in Port Harcourt',
                'probability' => 80,
                'affected_population' => 120000,
                'affected_area' => 35.8,
                'expected_rainfall' => 280,
                'year' => 2025,
                'period' => 'JAS'
            ]
        ];

        // Apply filters
        if ($state !== 'all') {
            $floodData = array_filter($floodData, function($item) use ($state) {
                return $item['state'] === $state;
            });
        }

        if ($riskLevel !== 'all') {
            $floodData = array_filter($floodData, function($item) use ($riskLevel) {
                return $item['risk'] === $riskLevel;
            });
        }

        if ($period !== 'all') {
            $floodData = array_filter($floodData, function($item) use ($period) {
                return $item['period'] === $period;
            });
        }

        return array_values($floodData);
    }

    private function generateStatistics($floodData)
    {
        $totalCommunities = count($floodData);
        $highRisk = count(array_filter($floodData, function($item) { return $item['risk'] === 'High'; }));
        $moderateRisk = count(array_filter($floodData, function($item) { return $item['risk'] === 'Moderate'; }));
        $lowRisk = count(array_filter($floodData, function($item) { return $item['risk'] === 'Low'; }));

        $totalPopulationAtRisk = array_sum(array_column($floodData, 'affected_population'));
        $totalAffectedArea = array_sum(array_column($floodData, 'affected_area'));

        return [
            'total_communities' => $totalCommunities,
            'high_risk' => $highRisk,
            'moderate_risk' => $moderateRisk,
            'low_risk' => $lowRisk,
            'total_population_at_risk' => $totalPopulationAtRisk,
            'total_affected_area' => $totalAffectedArea,
            'states_affected' => count(array_unique(array_column($floodData, 'state'))),
            'lgas_affected' => count(array_unique(array_column($floodData, 'lga')))
        ];
    }

    private function generateCommunityAlerts($floodData = null)
    {
        return [
            [
                'id' => 1,
                'state' => 'Lagos',
                'lga' => 'Lagos Island',
                'communities' => ['Victoria Island', 'Ikoyi', 'Lagos Island'],
                'risk_level' => 'High',
                'alert_type' => 'Major/Destructive',
                'issued_at' => Carbon::now()->subHours(2),
                'valid_until' => Carbon::now()->addHours(24),
                'description' => 'Severe flooding expected due to heavy rainfall and high tide'
            ],
            [
                'id' => 2,
                'state' => 'FCT',
                'lga' => 'Abuja Municipal',
                'communities' => ['Garki', 'Wuse', 'Maitama'],
                'risk_level' => 'Moderate',
                'alert_type' => 'Watch',
                'issued_at' => Carbon::now()->subHours(1),
                'valid_until' => Carbon::now()->addHours(12),
                'description' => 'Flash flooding possible in low-lying areas'
            ]
        ];
    }

    private function generateSensorData()
    {
        return [
            [
                'id' => 1,
                'name' => 'Lagos Lagoon Water Level',
                'type' => 'Water Level',
                'location' => 'Lagos Lagoon',
                'current_value' => 2.45,
                'unit' => 'meters',
                'status' => 'Normal',
                'last_updated' => Carbon::now()->subMinutes(15),
                'threshold_warning' => 3.0,
                'threshold_critical' => 3.5
            ],
            [
                'id' => 2,
                'name' => 'Abuja Rainfall Station',
                'type' => 'Rainfall',
                'location' => 'FCT Abuja',
                'current_value' => 15.2,
                'unit' => 'mm/hr',
                'status' => 'Warning',
                'last_updated' => Carbon::now()->subMinutes(5),
                'threshold_warning' => 10.0,
                'threshold_critical' => 25.0
            ],
            [
                'id' => 3,
                'name' => 'River Niger Level - Lokoja',
                'type' => 'River Level',
                'location' => 'Lokoja, Kogi',
                'current_value' => 8.7,
                'unit' => 'meters',
                'status' => 'Critical',
                'last_updated' => Carbon::now()->subMinutes(10),
                'threshold_warning' => 7.5,
                'threshold_critical' => 8.5
            ]
        ];
    }

    private function generateForecastData()
    {
        $forecastData = [];
        $baseDate = Carbon::now();

        // Generate 7-day forecast
        for ($i = 0; $i < 7; $i++) {
            $date = $baseDate->copy()->addDays($i);
            $forecastData[] = [
                'date' => $date->format('Y-m-d'),
                'day_name' => $date->format('l'),
                'rainfall_probability' => rand(20, 90),
                'expected_rainfall' => rand(5, 50),
                'flood_risk' => $this->calculateFloodRisk(rand(20, 90), rand(5, 50)),
                'temperature_max' => rand(28, 35),
                'temperature_min' => rand(20, 25),
                'humidity' => rand(60, 90),
                'wind_speed' => rand(5, 20)
            ];
        }

        return $forecastData;
    }

    private function calculateFloodRisk($rainfallProb, $expectedRainfall)
    {
        if ($rainfallProb > 70 && $expectedRainfall > 30) {
            return 'High';
        } elseif ($rainfallProb > 50 && $expectedRainfall > 15) {
            return 'Moderate';
        } else {
            return 'Low';
        }
    }

    private function exportToCsv($data)
    {
        $filename = 'flood_data_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($data) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, ['ID', 'State', 'LGA', 'Community', 'Risk Level', 'Flood Type', 'Probability (%)', 'Affected Population', 'Affected Area (sq km)', 'Expected Rainfall (mm)']);

            // Add data rows
            foreach ($data as $row) {
                fputcsv($file, [
                    $row['id'],
                    $row['state'],
                    $row['lga'],
                    $row['community'],
                    $row['risk'],
                    $row['flood_type'],
                    $row['probability'],
                    $row['affected_population'],
                    $row['affected_area'],
                    $row['expected_rainfall']
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportToGeoJson($data)
    {
        $features = [];

        foreach ($data as $item) {
            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$item['lng'], $item['lat']]
                ],
                'properties' => [
                    'id' => $item['id'],
                    'state' => $item['state'],
                    'lga' => $item['lga'],
                    'community' => $item['community'],
                    'risk_level' => $item['risk'],
                    'flood_type' => $item['flood_type'],
                    'probability' => $item['probability'],
                    'affected_population' => $item['affected_population'],
                    'affected_area' => $item['affected_area'],
                    'expected_rainfall' => $item['expected_rainfall'],
                    'description' => $item['description']
                ]
            ];
        }

        $geoJson = [
            'type' => 'FeatureCollection',
            'features' => $features
        ];

        $filename = 'flood_data_' . date('Y-m-d_H-i-s') . '.geojson';

        return response()->json($geoJson)
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    private function exportToPdf($data)
    {
        // Create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('NIHSA');
        $pdf->SetAuthor('Nigeria Hydrological Services Agency');
        $pdf->SetTitle('Flood Risk Assessment Report');
        $pdf->SetSubject('Flood Data Export');

        // Set default header data
        $pdf->SetHeaderData('', 0, 'NIHSA - Flood Risk Assessment Report', 'Generated on ' . date('F j, Y, g:i a'));

        // Set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add title
        $pdf->Cell(0, 10, 'Flood Risk Assessment Summary', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
        $pdf->Ln(5);

        // Add summary statistics
        $highRisk = collect($data)->where('risk', 'High')->count();
        $moderateRisk = collect($data)->where('risk', 'Moderate')->count();
        $lowRisk = collect($data)->where('risk', 'Low')->count();
        $totalCommunities = count($data);

        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(0, 8, 'Summary Statistics:', 0, 1, 'L');
        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(0, 6, "Total Communities: {$totalCommunities}", 0, 1, 'L');
        $pdf->Cell(0, 6, "High Risk Areas: {$highRisk}", 0, 1, 'L');
        $pdf->Cell(0, 6, "Moderate Risk Areas: {$moderateRisk}", 0, 1, 'L');
        $pdf->Cell(0, 6, "Low Risk Areas: {$lowRisk}", 0, 1, 'L');
        $pdf->Ln(10);

        // Add table header
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(30, 8, 'State', 1, 0, 'C');
        $pdf->Cell(30, 8, 'LGA', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Community', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Risk Level', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Flood Type', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Population', 1, 1, 'C');

        // Add data rows
        $pdf->SetFont('helvetica', '', 8);
        foreach ($data as $row) {
            // Check if we need a new page
            if ($pdf->GetY() > 250) {
                $pdf->AddPage();
                // Re-add header
                $pdf->SetFont('helvetica', 'B', 9);
                $pdf->Cell(30, 8, 'State', 1, 0, 'C');
                $pdf->Cell(30, 8, 'LGA', 1, 0, 'C');
                $pdf->Cell(35, 8, 'Community', 1, 0, 'C');
                $pdf->Cell(25, 8, 'Risk Level', 1, 0, 'C');
                $pdf->Cell(25, 8, 'Flood Type', 1, 0, 'C');
                $pdf->Cell(25, 8, 'Population', 1, 1, 'C');
                $pdf->SetFont('helvetica', '', 8);
            }

            // Set background color based on risk level
            $fillColor = [255, 255, 255]; // Default white
            if ($row['risk'] === 'High') {
                $fillColor = [255, 235, 235]; // Light red
            } elseif ($row['risk'] === 'Moderate') {
                $fillColor = [255, 248, 220]; // Light orange
            } elseif ($row['risk'] === 'Low') {
                $fillColor = [235, 255, 235]; // Light green
            }

            $pdf->SetFillColor($fillColor[0], $fillColor[1], $fillColor[2]);

            $pdf->Cell(30, 6, substr($row['state'], 0, 12), 1, 0, 'L', 1);
            $pdf->Cell(30, 6, substr($row['lga'], 0, 12), 1, 0, 'L', 1);
            $pdf->Cell(35, 6, substr($row['community'], 0, 15), 1, 0, 'L', 1);
            $pdf->Cell(25, 6, $row['risk'], 1, 0, 'C', 1);
            $pdf->Cell(25, 6, substr($row['flood_type'], 0, 10), 1, 0, 'C', 1);
            $pdf->Cell(25, 6, number_format($row['affected_population']), 1, 1, 'R', 1);
        }

        // Generate filename
        $filename = 'flood_risk_report_' . date('Y-m-d_H-i-s') . '.pdf';

        // Output PDF
        return response($pdf->Output($filename, 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }
}
