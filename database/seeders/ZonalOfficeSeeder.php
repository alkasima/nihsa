<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ZonalOffice;

class ZonalOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ZonalOffice::create([
            'name' => 'North Central Zonal Office',
            'location' => 'Abuja',
            'address' => 'Plot 1234, Wuse II, Abuja FCT',
            'phone' => '+234 9 123 4567',
            'email' => 'northcentral@nihsa.gov.ng',
            'description' => 'Responsible for flood monitoring and water resources management in the North Central region including Abuja, Niger, Kogi, Benue, Plateau, Nasarawa, and Kwara states.',
            'latitude' => 9.0765,
            'longitude' => 8.6753,
            'states_covered' => 'FCT, Niger, Kogi, Benue, Plateau, Nasarawa, Kwara',
        ]);

        ZonalOffice::create([
            'name' => 'North East Zonal Office',
            'location' => 'Bauchi',
            'address' => 'Federal Secretariat Complex, Bauchi, Bauchi State',
            'phone' => '+234 77 543 2109',
            'email' => 'northeast@nihsa.gov.ng',
            'description' => 'Covers flood forecasting and water management for Adamawa, Bauchi, Borno, Gombe, Taraba, and Yobe states.',
            'latitude' => 10.3157,
            'longitude' => 9.8442,
            'states_covered' => 'Adamawa, Bauchi, Borno, Gombe, Taraba, Yobe',
        ]);

        ZonalOffice::create([
            'name' => 'North West Zonal Office',
            'location' => 'Kano',
            'address' => 'Kano State Secretariat, Kano',
            'phone' => '+234 64 987 6543',
            'email' => 'northwest@nihsa.gov.ng',
            'description' => 'Manages water resources and flood monitoring for Jigawa, Kaduna, Kano, Katsina, Kebbi, Sokoto, and Zamfara states.',
            'latitude' => 12.0022,
            'longitude' => 8.5919,
            'states_covered' => 'Jigawa, Kaduna, Kano, Katsina, Kebbi, Sokoto, Zamfara',
        ]);

        ZonalOffice::create([
            'name' => 'South East Zonal Office',
            'location' => 'Enugu',
            'address' => 'Federal Secretariat, Independence Layout, Enugu',
            'phone' => '+234 42 256 7890',
            'email' => 'southeast@nihsa.gov.ng',
            'description' => 'Responsible for Abia, Anambra, Ebonyi, Enugu, and Imo states water resources management.',
            'latitude' => 6.4474,
            'longitude' => 7.4942,
            'states_covered' => 'Abia, Anambra, Ebonyi, Enugu, Imo',
        ]);

        ZonalOffice::create([
            'name' => 'South South Zonal Office',
            'location' => 'Port Harcourt',
            'address' => 'Federal Secretariat Complex, Aba Road, Port Harcourt',
            'phone' => '+234 84 234 5678',
            'email' => 'southsouth@nihsa.gov.ng',
            'description' => 'Covers Akwa Ibom, Bayelsa, Cross River, Delta, Edo, and Rivers states.',
            'latitude' => 4.8156,
            'longitude' => 7.0498,
            'states_covered' => 'Akwa Ibom, Bayelsa, Cross River, Delta, Edo, Rivers',
        ]);

        ZonalOffice::create([
            'name' => 'South West Zonal Office',
            'location' => 'Ibadan',
            'address' => 'Federal Secretariat, Ikolaba, Ibadan, Oyo State',
            'phone' => '+234 2 241 6800',
            'email' => 'southwest@nihsa.gov.ng',
            'description' => 'Manages water resources for Ekiti, Lagos, Ogun, Ondo, Osun, and Oyo states.',
            'latitude' => 7.3775,
            'longitude' => 3.9470,
            'states_covered' => 'Ekiti, Lagos, Ogun, Ondo, Osun, Oyo',
        ]);
    }
}
