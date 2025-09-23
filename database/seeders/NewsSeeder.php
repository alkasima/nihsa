<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure an admin user exists
        $admin = User::first();
        if (! $admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@nihsa.test',
                'password' => Hash::make('Secret123!'),
            ]);
        }

        $items = [
            [
                'title' => '2025 Annual Flood Outlook Released',
                'content' => '<p>The Nigeria Hydrological Services Agency (NIHSA) has released the 2025 Annual Flood Outlook (AFO) with predictions for the rainy season.</p>',
                'image' => 'images/flood.jpg',
                'category' => 'Press Release',
                'is_featured' => true,
                'published_at' => now()->subDays(30),
                'user_id' => $admin->id,
            ],
            [
                'title' => 'NIHSA Partners with International Organizations',
                'content' => '<p>NIHSA signs MOU with international organizations to improve flood forecasting capabilities.</p>',
                'image' => 'images/dg.jpg',
                'category' => 'News',
                'is_featured' => true,
                'published_at' => now()->subDays(45),
                'user_id' => $admin->id,
            ],
            [
                'title' => 'New Hydrological Stations Commissioned',
                'content' => '<p>NIHSA commissions 50 new hydrological stations across the country to improve data collection.</p>',
                'image' => 'images/hydro.jpg',
                'category' => 'News',
                'is_featured' => false,
                'published_at' => now()->subDays(60),
                'user_id' => $admin->id,
            ],
        ];

        foreach ($items as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
