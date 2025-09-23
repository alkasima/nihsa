<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publication;

class PublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publication::create([
            'title' => '2025 Annual Flood Outlook',
            'description' => 'Comprehensive flood predictions for the 2025 rainy season across Nigeria.',
            'file_path' => 'publications/2025-annual-flood-outlook.pdf',
            'type' => 'AFO',
            'year' => 2025,
            'publication_date' => '2025-04-01',
            'is_featured' => true,
        ]);

        Publication::create([
            'title' => 'Flood Mitigation & Adaptation Measures',
            'description' => 'Guidelines for flood mitigation and adaptation strategies.',
            'file_path' => 'publications/flood-mitigation-adaptation-measures.pdf',
            'type' => 'Report',
            'year' => 2025,
            'publication_date' => '2025-04-01',
            'is_featured' => true,
        ]);

        Publication::create([
            'title' => 'Flood Risk Communication',
            'description' => 'Strategies for effective flood risk communication.',
            'file_path' => 'publications/flood-risk-communication.pdf',
            'type' => 'Report',
            'year' => 2025,
            'publication_date' => '2025-04-01',
            'is_featured' => true,
        ]);

        Publication::create([
            'title' => '2024 Annual Flood Outlook',
            'description' => 'Comprehensive flood predictions for the 2024 rainy season.',
            'file_path' => 'publications/2024-annual-flood-outlook.pdf',
            'type' => 'AFO',
            'year' => 2024,
            'publication_date' => '2024-04-01',
            'is_featured' => false,
        ]);

        Publication::create([
            'title' => '2023 Annual Flood Outlook',
            'description' => 'Comprehensive flood predictions for the 2023 rainy season.',
            'file_path' => 'publications/2023-annual-flood-outlook.pdf',
            'type' => 'AFO',
            'year' => 2023,
            'publication_date' => '2023-04-01',
            'is_featured' => false,
        ]);

        Publication::create([
            'title' => 'Flood and Drought Bulletin - January 2025',
            'description' => 'Monthly bulletin on flood and drought conditions across Nigeria.',
            'file_path' => 'publications/flood-drought-bulletin-jan-2025.pdf',
            'type' => 'Bulletin',
            'year' => 2025,
            'publication_date' => '2025-01-31',
            'is_featured' => false,
        ]);

        Publication::create([
            'title' => 'Flood and Drought Bulletin - February 2025',
            'description' => 'Monthly bulletin on flood and drought conditions across Nigeria.',
            'file_path' => 'publications/flood-drought-bulletin-feb-2025.pdf',
            'type' => 'Bulletin',
            'year' => 2025,
            'publication_date' => '2025-02-28',
            'is_featured' => false,
        ]);

        Publication::create([
            'title' => 'Flood and Drought Bulletin - March 2025',
            'description' => 'Monthly bulletin on flood and drought conditions across Nigeria.',
            'file_path' => 'publications/flood-drought-bulletin-mar-2025.pdf',
            'type' => 'Bulletin',
            'year' => 2025,
            'publication_date' => '2025-03-31',
            'is_featured' => false,
        ]);
    }
}