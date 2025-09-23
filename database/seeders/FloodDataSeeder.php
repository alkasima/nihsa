<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FloodData;
use Carbon\Carbon;

class FloodDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $floodData = [
            // FCT Abuja
            [
                'state' => 'FCT',
                'lga' => 'Abuja Municipal',
                'community' => 'Garki',
                'risk_level' => 'High',
                'flood_type' => 'Flash/Urban',
                'forecast_date' => '2025-07-15',
                'description' => 'High risk of flooding in Abuja Municipal Area Council due to poor drainage and heavy rainfall',
                'latitude' => 9.0765,
                'longitude' => 7.3986,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 85,
                'affected_population' => 150000,
                'affected_area' => 45.5,
                'expected_rainfall' => 250
            ],
            [
                'state' => 'FCT',
                'lga' => 'Gwagwalada',
                'community' => 'Gwagwalada Town',
                'risk_level' => 'Moderate',
                'flood_type' => 'Riverine',
                'forecast_date' => '2025-08-01',
                'description' => 'Moderate flood risk along river channels in Gwagwalada',
                'latitude' => 8.9423,
                'longitude' => 7.0833,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 65,
                'affected_population' => 75000,
                'affected_area' => 32.1,
                'expected_rainfall' => 180
            ],

            // Lagos State
            [
                'state' => 'Lagos',
                'lga' => 'Ikorodu',
                'community' => 'Ikorodu Central',
                'risk_level' => 'High',
                'flood_type' => 'Coastal',
                'forecast_date' => '2025-07-20',
                'description' => 'High coastal flooding risk due to sea level rise and storm surge',
                'latitude' => 6.6018,
                'longitude' => 3.5106,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 90,
                'affected_population' => 300000,
                'affected_area' => 120.8,
                'expected_rainfall' => 320
            ],
            [
                'state' => 'Lagos',
                'lga' => 'Lagos Island',
                'community' => 'Victoria Island',
                'risk_level' => 'High',
                'flood_type' => 'Flash/Urban',
                'forecast_date' => '2025-08-10',
                'description' => 'Urban flooding expected due to inadequate drainage infrastructure',
                'latitude' => 6.4281,
                'longitude' => 3.4219,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 80,
                'affected_population' => 250000,
                'affected_area' => 85.3,
                'expected_rainfall' => 280
            ],

            // Rivers State
            [
                'state' => 'Rivers',
                'lga' => 'Port Harcourt',
                'community' => 'Port Harcourt City',
                'risk_level' => 'High',
                'flood_type' => 'Riverine',
                'forecast_date' => '2025-09-05',
                'description' => 'High riverine flooding risk along Niger Delta waterways',
                'latitude' => 4.8156,
                'longitude' => 7.0498,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 88,
                'affected_population' => 400000,
                'affected_area' => 156.7,
                'expected_rainfall' => 380
            ],

            // Kano State
            [
                'state' => 'Kano',
                'lga' => 'Kano Municipal',
                'community' => 'Sabon Gari',
                'risk_level' => 'Moderate',
                'flood_type' => 'Flash/Urban',
                'forecast_date' => '2025-08-15',
                'description' => 'Moderate urban flooding risk in densely populated areas',
                'latitude' => 12.0022,
                'longitude' => 8.5920,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 60,
                'affected_population' => 180000,
                'affected_area' => 67.4,
                'expected_rainfall' => 150
            ],

            // Kaduna State
            [
                'state' => 'Kaduna',
                'lga' => 'Kaduna North',
                'community' => 'Tudun Wada',
                'risk_level' => 'Moderate',
                'flood_type' => 'Riverine',
                'forecast_date' => '2025-08-20',
                'description' => 'Riverine flooding along Kaduna River expected',
                'latitude' => 10.5105,
                'longitude' => 7.4165,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 70,
                'affected_population' => 120000,
                'affected_area' => 89.2,
                'expected_rainfall' => 200
            ],

            // Benue State
            [
                'state' => 'Benue',
                'lga' => 'Makurdi',
                'community' => 'Makurdi Town',
                'risk_level' => 'High',
                'flood_type' => 'Riverine',
                'forecast_date' => '2025-09-10',
                'description' => 'High risk of Benue River flooding affecting agricultural areas',
                'latitude' => 7.7319,
                'longitude' => 8.5324,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 85,
                'affected_population' => 200000,
                'affected_area' => 134.6,
                'expected_rainfall' => 290
            ],

            // Delta State
            [
                'state' => 'Delta',
                'lga' => 'Warri South',
                'community' => 'Warri',
                'risk_level' => 'High',
                'flood_type' => 'Coastal',
                'forecast_date' => '2025-08-25',
                'description' => 'Coastal flooding risk in Niger Delta region',
                'latitude' => 5.5160,
                'longitude' => 5.7500,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 82,
                'affected_population' => 180000,
                'affected_area' => 98.3,
                'expected_rainfall' => 340
            ],

            // Ogun State
            [
                'state' => 'Ogun',
                'lga' => 'Abeokuta North',
                'community' => 'Abeokuta',
                'risk_level' => 'Low',
                'flood_type' => 'Riverine',
                'forecast_date' => '2025-09-01',
                'description' => 'Low to moderate flood risk along Ogun River',
                'latitude' => 7.1475,
                'longitude' => 3.3619,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 45,
                'affected_population' => 90000,
                'affected_area' => 56.8,
                'expected_rainfall' => 160
            ],

            // Anambra State
            [
                'state' => 'Anambra',
                'lga' => 'Onitsha North',
                'community' => 'Onitsha',
                'risk_level' => 'Moderate',
                'flood_type' => 'Riverine',
                'forecast_date' => '2025-08-30',
                'description' => 'Moderate flooding risk along Niger River in commercial areas',
                'latitude' => 6.1441,
                'longitude' => 6.7882,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 68,
                'affected_population' => 160000,
                'affected_area' => 78.9,
                'expected_rainfall' => 220
            ],

            // Cross River State
            [
                'state' => 'Cross River',
                'lga' => 'Calabar Municipal',
                'community' => 'Calabar',
                'risk_level' => 'Moderate',
                'flood_type' => 'Coastal',
                'forecast_date' => '2025-09-15',
                'description' => 'Coastal flooding risk in Cross River estuary',
                'latitude' => 4.9517,
                'longitude' => 8.3220,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 62,
                'affected_population' => 140000,
                'affected_area' => 92.1,
                'expected_rainfall' => 310
            ],

            // Bayelsa State
            [
                'state' => 'Bayelsa',
                'lga' => 'Yenagoa',
                'community' => 'Yenagoa Town',
                'risk_level' => 'High',
                'flood_type' => 'Coastal',
                'forecast_date' => '2025-08-05',
                'description' => 'High coastal and riverine flooding risk in Niger Delta',
                'latitude' => 4.9267,
                'longitude' => 6.2676,
                'year' => 2025,
                'period' => 'JAS',
                'probability' => 92,
                'affected_population' => 220000,
                'affected_area' => 145.7,
                'expected_rainfall' => 420
            ]
        ];

        foreach ($floodData as $data) {
            FloodData::create($data);
        }
    }
}
