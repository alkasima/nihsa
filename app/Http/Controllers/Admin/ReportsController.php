<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\AnalyticsService;

class ReportsController extends Controller
{
    /**
     * Display the website analytics dashboard.
     */
    public function analytics(Request $request)
    {
        // Get date range from request or default to last 30 days
        $dateRange = $request->get('date_range', 'last-30-days');

        // Initialize analytics service
        $analyticsService = new AnalyticsService();

        // Get real analytics data
        $analyticsData = $analyticsService->getAnalyticsData($dateRange);

        return view('admin.reports.analytics', $analyticsData);
    }

    /**
     * Display the flood data visualization dashboard.
     */
    public function floodData(Request $request)
    {
        // Get filter parameters
        $year = $request->input('year', 2025);
        $state = $request->input('state', 'all');
        $riskLevel = $request->input('risk_level', 'all');
        
        // In a real implementation, we would fetch flood data from the database
        // For now, we'll create some dummy data
        
        // States with flood risk
        $stateRiskData = [
            ['state' => 'Lagos', 'high_risk' => 12, 'moderate_risk' => 8, 'low_risk' => 5],
            ['state' => 'Rivers', 'high_risk' => 15, 'moderate_risk' => 6, 'low_risk' => 2],
            ['state' => 'Bayelsa', 'high_risk' => 18, 'moderate_risk' => 5, 'low_risk' => 1],
            ['state' => 'Delta', 'high_risk' => 14, 'moderate_risk' => 7, 'low_risk' => 3],
            ['state' => 'Kogi', 'high_risk' => 10, 'moderate_risk' => 9, 'low_risk' => 4],
            ['state' => 'Anambra', 'high_risk' => 8, 'moderate_risk' => 10, 'low_risk' => 5],
            ['state' => 'Benue', 'high_risk' => 9, 'moderate_risk' => 8, 'low_risk' => 6],
            ['state' => 'Cross River', 'high_risk' => 7, 'moderate_risk' => 9, 'low_risk' => 7],
            ['state' => 'Edo', 'high_risk' => 6, 'moderate_risk' => 10, 'low_risk' => 8],
            ['state' => 'Imo', 'high_risk' => 5, 'moderate_risk' => 11, 'low_risk' => 9],
        ];
        
        // Monthly flood incidents
        $monthlyFloodIncidents = [
            ['month' => 'Jan', 'incidents' => 2],
            ['month' => 'Feb', 'incidents' => 1],
            ['month' => 'Mar', 'incidents' => 3],
            ['month' => 'Apr', 'incidents' => 5],
            ['month' => 'May', 'incidents' => 8],
            ['month' => 'Jun', 'incidents' => 12],
            ['month' => 'Jul', 'incidents' => 18],
            ['month' => 'Aug', 'incidents' => 25],
            ['month' => 'Sep', 'incidents' => 20],
            ['month' => 'Oct', 'incidents' => 15],
            ['month' => 'Nov', 'incidents' => 7],
            ['month' => 'Dec', 'incidents' => 3],
        ];
        
        // Flood impact data
        $floodImpactData = [
            'affected_area' => '1,245 sq km',
            'affected_population' => '1.2 million',
            'displaced_persons' => '350,000',
            'casualties' => '45',
            'infrastructure_damage' => '$25 million',
            'agricultural_damage' => '$15 million',
        ];
        
        // Yearly comparison
        $yearlyComparison = [
            ['year' => 2021, 'incidents' => 85, 'affected_area' => 950, 'affected_population' => 950000],
            ['year' => 2022, 'incidents' => 92, 'affected_area' => 1050, 'affected_population' => 1050000],
            ['year' => 2023, 'incidents' => 105, 'affected_area' => 1150, 'affected_population' => 1150000],
            ['year' => 2024, 'incidents' => 112, 'affected_area' => 1200, 'affected_population' => 1200000],
            ['year' => 2025, 'incidents' => 119, 'affected_area' => 1245, 'affected_population' => 1250000],
        ];
        
        // Risk level distribution
        $riskLevelDistribution = [
            ['level' => 'High', 'count' => 125, 'percentage' => 42],
            ['level' => 'Moderate', 'count' => 98, 'percentage' => 33],
            ['level' => 'Low', 'count' => 75, 'percentage' => 25],
        ];
        
        // Available years for filtering
        $years = [2021, 2022, 2023, 2024, 2025];
        
        // Available states for filtering
        $states = [
            'all' => 'All States',
            'Lagos' => 'Lagos',
            'Rivers' => 'Rivers',
            'Bayelsa' => 'Bayelsa',
            'Delta' => 'Delta',
            'Kogi' => 'Kogi',
            'Anambra' => 'Anambra',
            'Benue' => 'Benue',
            'Cross River' => 'Cross River',
            'Edo' => 'Edo',
            'Imo' => 'Imo',
        ];
        
        // Available risk levels for filtering
        $riskLevels = [
            'all' => 'All Levels',
            'high' => 'High',
            'moderate' => 'Moderate',
            'low' => 'Low',
        ];
        
        return view('admin.reports.flood-data', compact(
            'stateRiskData',
            'monthlyFloodIncidents',
            'floodImpactData',
            'yearlyComparison',
            'riskLevelDistribution',
            'years',
            'states',
            'riskLevels',
            'year',
            'state',
            'riskLevel'
        ));
    }

    /**
     * Display the downloadable reports page.
     */
    public function downloads()
    {
        // In a real implementation, we would fetch reports from the database
        // For now, we'll create some dummy data
        
        // Available reports
        $reports = [
            [
                'id' => 1,
                'title' => 'Website Analytics Report - July 2025',
                'description' => 'Monthly analytics report showing website traffic, user behavior, and engagement metrics.',
                'type' => 'analytics',
                'format' => 'PDF',
                'size' => '2.5 MB',
                'created_at' => '2025-08-01 09:30:00',
                'download_count' => 15,
            ],
            [
                'id' => 2,
                'title' => 'Flood Data Summary Report - Q2 2025',
                'description' => 'Quarterly report summarizing flood incidents, affected areas, and impact across Nigeria.',
                'type' => 'flood-data',
                'format' => 'PDF',
                'size' => '3.8 MB',
                'created_at' => '2025-07-15 14:45:00',
                'download_count' => 28,
            ],
            [
                'id' => 3,
                'title' => 'User Activity Report - June 2025',
                'description' => 'Monthly report on user registrations, data requests, and engagement with the website.',
                'type' => 'user-activity',
                'format' => 'PDF',
                'size' => '1.7 MB',
                'created_at' => '2025-07-05 11:20:00',
                'download_count' => 12,
            ],
            [
                'id' => 4,
                'title' => 'Flood Risk Assessment - Lagos State 2025',
                'description' => 'Detailed analysis of flood risk areas in Lagos State with recommendations for mitigation.',
                'type' => 'flood-data',
                'format' => 'PDF',
                'size' => '5.2 MB',
                'created_at' => '2025-06-20 16:10:00',
                'download_count' => 45,
            ],
            [
                'id' => 5,
                'title' => 'Website Analytics Data - Q2 2025',
                'description' => 'Raw analytics data for Q2 2025 in Excel format for custom analysis.',
                'type' => 'analytics',
                'format' => 'Excel',
                'size' => '4.1 MB',
                'created_at' => '2025-07-10 13:30:00',
                'download_count' => 8,
            ],
            [
                'id' => 6,
                'title' => 'Flood Incidents Map Data - 2025',
                'description' => 'GeoJSON data of flood incidents across Nigeria for use in GIS applications.',
                'type' => 'flood-data',
                'format' => 'GeoJSON',
                'size' => '3.5 MB',
                'created_at' => '2025-07-25 10:15:00',
                'download_count' => 17,
            ],
            [
                'id' => 7,
                'title' => 'Data Requests Summary - H1 2025',
                'description' => 'Summary of data requests received, approved, and fulfilled in the first half of 2025.',
                'type' => 'user-activity',
                'format' => 'PDF',
                'size' => '2.2 MB',
                'created_at' => '2025-07-20 09:45:00',
                'download_count' => 10,
            ],
            [
                'id' => 8,
                'title' => 'Annual Flood Outlook Comparison (2021-2025)',
                'description' => 'Comparative analysis of Annual Flood Outlook predictions and actual flood incidents over 5 years.',
                'type' => 'flood-data',
                'format' => 'PDF',
                'size' => '6.8 MB',
                'created_at' => '2025-06-30 15:20:00',
                'download_count' => 32,
            ],
        ];
        
        // Report types for filtering
        $reportTypes = [
            'all' => 'All Types',
            'analytics' => 'Website Analytics',
            'flood-data' => 'Flood Data',
            'user-activity' => 'User Activity',
        ];
        
        // Report formats for filtering
        $reportFormats = [
            'all' => 'All Formats',
            'PDF' => 'PDF',
            'Excel' => 'Excel',
            'CSV' => 'CSV',
            'GeoJSON' => 'GeoJSON',
        ];
        
        return view('admin.reports.downloads', compact('reports', 'reportTypes', 'reportFormats'));
    }

    /**
     * Generate a new report.
     */
    public function generate(Request $request)
    {
        $validated = $request->validate([
            'report_type' => 'required|string|in:analytics,flood-data,user-activity',
            'report_format' => 'required|string|in:PDF,Excel,CSV,GeoJSON',
            'date_range' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        // In a real implementation, we would generate the report and save it to the database
        // For now, we'll just redirect back with a success message
        
        return redirect()->route('admin.reports.downloads')->with('success', 'Report generated successfully.');
    }

    /**
     * Download a report.
     */
    public function download($id)
    {
        // In a real implementation, we would fetch the report from the database and return the file
        // For now, we'll just create a dummy PDF file and return it
        
        // Create a dummy PDF file
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('NIHSA');
        $pdf->SetAuthor('Nigeria Hydrological Services Agency');
        $pdf->SetTitle('NIHSA Report');
        $pdf->SetSubject('NIHSA Report');
        $pdf->SetKeywords('NIHSA, Report, Flood, Data');
        $pdf->SetHeaderData('', 0, 'Nigeria Hydrological Services Agency', 'Report');
        $pdf->setHeaderFont(['helvetica', '', 10]);
        $pdf->setFooterFont(['helvetica', '', 8]);
        $pdf->SetDefaultMonospacedFont('courier');
        $pdf->SetMargins(15, 15, 15);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(10);
        $pdf->SetAutoPageBreak(true, 25);
        $pdf->SetFont('helvetica', '', 10);
        $pdf->AddPage();
        $pdf->Write(0, 'This is a sample report generated by NIHSA.', '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln(10);
        $pdf->Write(0, 'Report ID: ' . $id, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Generated on: ' . date('F j, Y, g:i a'), '', 0, 'L', true, 0, false, false, 0);
        $pdf->Ln(10);
        $pdf->Write(0, 'This report contains sample data for demonstration purposes only.', '', 0, 'L', true, 0, false, false, 0);
        
        // Save the PDF to a temporary file
        $tempFile = storage_path('app/temp/report_' . $id . '.pdf');
        $pdf->Output($tempFile, 'F');
        
        // Return the file as a download
        return response()->download($tempFile, 'NIHSA_Report_' . $id . '.pdf', [
            'Content-Type' => 'application/pdf',
        ])->deleteFileAfterSend(true);
    }
}
