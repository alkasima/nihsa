<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::create([
            'name' => 'Federal Ministry of Water Resources',
            'description' => 'The Federal Ministry of Water Resources is responsible for formulating and implementing policies and programs for the development and management of water resources in Nigeria.',
            'logo' => null,
            'website_url' => 'https://www.water.gov.ng',
            'partnership_type' => 'Government',
            'display_order' => 1,
        ]);

        Partner::create([
            'name' => 'Nigerian Meteorological Agency (NiMet)',
            'description' => 'NiMet provides weather and climate information for socioeconomic development of Nigeria through the production of weather forecasts and seasonal climate predictions.',
            'logo' => null,
            'website_url' => 'https://www.nimet.gov.ng',
            'partnership_type' => 'Government',
            'display_order' => 2,
        ]);

        Partner::create([
            'name' => 'National Emergency Management Agency (NEMA)',
            'description' => 'NEMA coordinates disaster management efforts in Nigeria, including flood disaster response and management.',
            'logo' => null,
            'website_url' => 'https://www.nema.gov.ng',
            'partnership_type' => 'Government',
            'display_order' => 3,
        ]);

        Partner::create([
            'name' => 'United Nations Development Programme (UNDP)',
            'description' => 'UNDP partners with Nigeria on sustainable development initiatives, including climate change adaptation and disaster risk reduction.',
            'logo' => null,
            'website_url' => 'https://www.undp.org',
            'partnership_type' => 'International',
            'display_order' => 4,
        ]);

        Partner::create([
            'name' => 'World Bank',
            'description' => 'The World Bank supports Nigeria\'s development through financing, technical assistance, and policy advice in various sectors including water resources management.',
            'logo' => null,
            'website_url' => 'https://www.worldbank.org',
            'partnership_type' => 'International',
            'display_order' => 5,
        ]);

        Partner::create([
            'name' => 'Nigerian Red Cross Society',
            'description' => 'The Nigerian Red Cross Society provides humanitarian services including disaster response, health services, and community development programs.',
            'logo' => null,
            'website_url' => 'https://www.redcrossnigeria.org',
            'partnership_type' => 'NGO',
            'display_order' => 6,
        ]);

        Partner::create([
            'name' => 'African Development Bank (AfDB)',
            'description' => 'AfDB supports regional member countries in their economic development and social progress through infrastructure development and capacity building.',
            'logo' => null,
            'website_url' => 'https://www.afdb.org',
            'partnership_type' => 'International',
            'display_order' => 7,
        ]);

        Partner::create([
            'name' => 'Japan International Cooperation Agency (JICA)',
            'description' => 'JICA provides technical cooperation and development assistance to Nigeria in various sectors including water resources and disaster management.',
            'logo' => null,
            'website_url' => 'https://www.jica.go.jp',
            'partnership_type' => 'International',
            'display_order' => 8,
        ]);
    }
}
