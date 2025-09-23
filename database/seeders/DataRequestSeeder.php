<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataRequest;

class DataRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DataRequest::create([
            'name' => 'John Smith',
            'email' => 'john.smith@example.com',
            'phone' => '+234 801 234 5678',
            'organization' => 'University of Lagos',
            'data_type' => 'Flood Data',
            'description' => 'Research on flood patterns in Lagos State for a PhD thesis on climate change impacts on urban flooding. The data will be used to develop predictive models for flood risk assessment.',
            'time_period' => '2020-2025',
            'geographic_area' => 'Lagos State',
            'data_format' => 'CSV',
            'additional_info' => 'I am particularly interested in daily flood levels and rainfall data for the specified period. Any additional information on flood damages would also be helpful.',
            'status' => 'pending',
        ]);

        DataRequest::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'phone' => '+234 802 345 6789',
            'organization' => 'Environmental Research Institute',
            'data_type' => 'Rainfall Data',
            'description' => 'Analysis of rainfall patterns for agricultural planning in northern Nigeria.',
            'time_period' => '2019-2024',
            'geographic_area' => 'Kano State',
            'data_format' => 'Excel',
            'additional_info' => 'Need monthly rainfall totals and daily precipitation data.',
            'status' => 'approved',
            'estimated_delivery' => '2025-05-15',
            'admin_notes' => 'Approved for research purposes. Data will be provided in Excel format as requested.',
        ]);

        DataRequest::create([
            'name' => 'Robert Johnson',
            'email' => 'robert.johnson@example.com',
            'phone' => '+234 803 456 7890',
            'organization' => 'Construction Company Ltd',
            'data_type' => 'Groundwater Data',
            'description' => 'Site assessment for construction project in Abuja.',
            'time_period' => '2022-2025',
            'geographic_area' => 'Abuja FCT',
            'data_format' => 'PDF Report',
            'additional_info' => 'Need groundwater level data for foundation design.',
            'status' => 'delivered',
            'delivered_at' => '2025-05-03 14:30:00',
            'delivered_by' => 'Admin User',
        ]);

        DataRequest::create([
            'name' => 'Emily Williams',
            'email' => 'emily.williams@example.com',
            'phone' => '+234 804 567 8901',
            'organization' => 'Water Resources Ministry',
            'data_type' => 'Surface Water Data',
            'description' => 'Water resource planning for regional development.',
            'time_period' => '2021-2025',
            'geographic_area' => 'Rivers State',
            'data_format' => 'Database',
            'additional_info' => 'Need comprehensive surface water quality and quantity data.',
            'status' => 'rejected',
            'rejection_reason' => 'Request scope too broad. Please specify particular water bodies and parameters needed.',
        ]);

        DataRequest::create([
            'name' => 'Michael Brown',
            'email' => 'michael.brown@example.com',
            'phone' => '+234 805 678 9012',
            'organization' => 'Research Institute',
            'data_type' => 'Water Quality Data',
            'description' => 'Environmental impact assessment study.',
            'time_period' => '2023-2025',
            'geographic_area' => 'Ogun State',
            'data_format' => 'CSV',
            'additional_info' => 'Need water quality parameters for industrial area assessment.',
            'status' => 'pending',
        ]);
    }
}