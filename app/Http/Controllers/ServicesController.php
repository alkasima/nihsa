<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display the services index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // In a real implementation, we would fetch services from the database
        // $services = Service::all();
        
        // For now, we'll create some dummy services
        $services = [
            [
                'id' => 1,
                'name' => 'Hydrological Data Collection',
                'description' => 'Collection of hydrological data from rivers, lakes, and other water bodies across Nigeria.',
                'icon' => 'fas fa-water',
                'category' => 'Data Services',
                'featured' => true
            ],
            [
                'id' => 2,
                'name' => 'Flood Forecasting and Early Warning',
                'description' => 'Real-time monitoring and early warning for potential flood events.',
                'icon' => 'fas fa-exclamation-triangle',
                'category' => 'Forecasting Services',
                'featured' => true
            ],
            [
                'id' => 3,
                'name' => 'Hydrological Modeling',
                'description' => 'Development and application of hydrological models for water resource management.',
                'icon' => 'fas fa-chart-line',
                'category' => 'Technical Services',
                'featured' => true
            ],
            [
                'id' => 4,
                'name' => 'Water Resources Assessment',
                'description' => 'Assessment of water resources availability and quality for various purposes.',
                'icon' => 'fas fa-tint',
                'category' => 'Assessment Services',
                'featured' => true
            ],
            [
                'id' => 5,
                'name' => 'Groundwater Monitoring',
                'description' => 'Monitoring of groundwater levels and quality across Nigeria.',
                'icon' => 'fas fa-mountain',
                'category' => 'Monitoring Services',
                'featured' => false
            ],
            [
                'id' => 6,
                'name' => 'Dam Safety Monitoring',
                'description' => 'Monitoring and assessment of dam safety parameters.',
                'icon' => 'fas fa-shield-alt',
                'category' => 'Monitoring Services',
                'featured' => false
            ],
            [
                'id' => 7,
                'name' => 'Hydrological Training and Capacity Building',
                'description' => 'Training programs on hydrological data collection, analysis, and management.',
                'icon' => 'fas fa-graduation-cap',
                'category' => 'Training Services',
                'featured' => false
            ],
            [
                'id' => 8,
                'name' => 'Consultancy Services',
                'description' => 'Expert consultancy on water resources management and flood control.',
                'icon' => 'fas fa-comments',
                'category' => 'Consultancy Services',
                'featured' => false
            ]
        ];
        
        // Group services by category
        $servicesByCategory = collect($services)->groupBy('category');
        
        // Get featured services
        $featuredServices = collect($services)->where('featured', true);
        
        return view('services.index', compact('services', 'servicesByCategory', 'featuredServices'));
    }
    
    /**
     * Display the specified service.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        // In a real implementation, we would fetch the service from the database
        // $service = Service::findOrFail($id);
        
        // For now, we'll create a dummy service
        $service = [
            'id' => $id,
            'name' => 'Flood Forecasting and Early Warning',
            'description' => 'NIHSA provides comprehensive flood forecasting and early warning services to help communities prepare for and respond to potential flood events. Our advanced monitoring systems and expert analysis enable timely and accurate flood predictions.',
            'icon' => 'fas fa-exclamation-triangle',
            'category' => 'Forecasting Services',
            'featured' => true,
            'benefits' => [
                'Early detection of potential flood events',
                'Timely warnings to at-risk communities',
                'Reduced loss of life and property damage',
                'Improved emergency response planning',
                'Enhanced community resilience to floods'
            ],
            'process' => [
                'Data collection from monitoring stations',
                'Analysis of rainfall patterns and river levels',
                'Application of hydrological models',
                'Generation of flood forecasts',
                'Dissemination of warnings to relevant authorities'
            ],
            'related_services' => [1, 3, 5]
        ];
        
        return view('services.show', compact('service'));
    }
}
