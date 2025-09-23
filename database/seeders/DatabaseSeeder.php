<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Seed flood data, publications, data requests, zonal offices, partners, and analytics
        $this->call([
            FloodDataSeeder::class,
            PublicationSeeder::class,
            DataRequestSeeder::class,
            ZonalOfficeSeeder::class,
            PartnerSeeder::class,
            AnalyticsSeeder::class,
        ]);
    }
}
