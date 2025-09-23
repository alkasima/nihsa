<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display the products index page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // In a real implementation, we would fetch products from the database
        // $products = Product::all();
        
        // For now, we'll create some dummy products
        $products = [
            [
                'id' => 1,
                'name' => 'Annual Flood Outlook (AFO)',
                'description' => 'Comprehensive annual report on flood predictions across Nigeria.',
                'image' => 'images/products/afo.jpg',
                'category' => 'Reports',
                'featured' => true
            ],
            [
                'id' => 2,
                'name' => 'Monthly Hydrological Bulletin',
                'description' => 'Monthly updates on hydrological conditions across Nigeria.',
                'image' => 'images/products/bulletin.jpg',
                'category' => 'Reports',
                'featured' => true
            ],
            [
                'id' => 3,
                'name' => 'Flood Risk Maps',
                'description' => 'Detailed maps showing flood risk zones across different states in Nigeria.',
                'image' => 'images/products/maps.jpg',
                'category' => 'Maps',
                'featured' => true
            ],
            [
                'id' => 4,
                'name' => 'Hydrological Yearbook',
                'description' => 'Annual compilation of hydrological data and analysis.',
                'image' => 'images/products/yearbook.jpg',
                'category' => 'Reports',
                'featured' => false
            ],
            [
                'id' => 5,
                'name' => 'Flood Early Warning System',
                'description' => 'Real-time flood monitoring and early warning system.',
                'image' => 'images/products/warning.jpg',
                'category' => 'Systems',
                'featured' => true
            ],
            [
                'id' => 6,
                'name' => 'Groundwater Resources Maps',
                'description' => 'Maps showing groundwater resources and aquifer systems in Nigeria.',
                'image' => 'images/products/groundwater.jpg',
                'category' => 'Maps',
                'featured' => false
            ],
            [
                'id' => 7,
                'name' => 'Drought Monitoring Reports',
                'description' => 'Reports on drought conditions and monitoring across Nigeria.',
                'image' => 'images/products/drought.jpg',
                'category' => 'Reports',
                'featured' => false
            ],
            [
                'id' => 8,
                'name' => 'Water Resources Assessment',
                'description' => 'Comprehensive assessment of water resources availability and usage.',
                'image' => 'images/products/assessment.jpg',
                'category' => 'Reports',
                'featured' => false
            ]
        ];
        
        // Group products by category
        $productsByCategory = collect($products)->groupBy('category');
        
        // Get featured products
        $featuredProducts = collect($products)->where('featured', true)->take(4);
        
        return view('products.index', compact('products', 'productsByCategory', 'featuredProducts'));
    }
    
    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        // In a real implementation, we would fetch the product from the database
        // $product = Product::findOrFail($id);
        
        // For now, we'll create a dummy product
        $product = [
            'id' => $id,
            'name' => 'Annual Flood Outlook (AFO)',
            'description' => 'The Annual Flood Outlook (AFO) is a comprehensive report that provides predictions and analysis of potential flood scenarios across Nigeria for the upcoming rainy season. It is a vital tool for disaster preparedness and planning.',
            'image' => 'images/products/afo.jpg',
            'category' => 'Reports',
            'featured' => true,
            'details' => [
                'Format' => 'PDF, Print',
                'Published' => 'Annually (March/April)',
                'Pages' => '150-200',
                'Coverage' => 'All 36 states and FCT'
            ],
            'features' => [
                'Flood risk predictions for all states',
                'Rainfall pattern analysis',
                'River level monitoring data',
                'Historical flood data comparison',
                'Mitigation recommendations',
                'State-by-state risk assessment'
            ],
            'related_products' => [2, 3, 5]
        ];
        
        return view('products.show', compact('product'));
    }
}
