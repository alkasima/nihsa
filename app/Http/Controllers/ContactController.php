<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZonalOffice;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // In a real implementation, we would fetch zonal offices from the database
        // $zonalOffices = ZonalOffice::all();

        // For now, we'll create some dummy data
        $zonalOffices = [
            [
                'id' => 1,
                'name' => 'Headquarters',
                'location' => 'Abuja',
                'address' => 'Plot 222, Foundation Plaza, Shettima Ali Monguno Crescent, Utako, Abuja, Nigeria',
                'phone' => '+234 801 234 5678',
                'email' => 'info@nihsa.gov.ng',
                'latitude' => 9.0765,
                'longitude' => 7.3986,
                'states_covered' => 'Federal Capital Territory'
            ],
            [
                'id' => 2,
                'name' => 'North Central Zonal Office',
                'location' => 'Jos',
                'address' => '123 Plateau Road, Jos, Plateau State, Nigeria',
                'phone' => '+234 802 345 6789',
                'email' => 'northcentral@nihsa.gov.ng',
                'latitude' => 9.8965,
                'longitude' => 8.8583,
                'states_covered' => 'Plateau, Nasarawa, Benue, Kogi, Niger, Kwara'
            ],
            [
                'id' => 3,
                'name' => 'North East Zonal Office',
                'location' => 'Maiduguri',
                'address' => '456 Borno Way, Maiduguri, Borno State, Nigeria',
                'phone' => '+234 803 456 7890',
                'email' => 'northeast@nihsa.gov.ng',
                'latitude' => 11.8333,
                'longitude' => 13.1500,
                'states_covered' => 'Borno, Yobe, Adamawa, Taraba, Gombe, Bauchi'
            ],
            [
                'id' => 4,
                'name' => 'North West Zonal Office',
                'location' => 'Kano',
                'address' => '789 Kano Road, Kano, Kano State, Nigeria',
                'phone' => '+234 804 567 8901',
                'email' => 'northwest@nihsa.gov.ng',
                'latitude' => 12.0000,
                'longitude' => 8.5167,
                'states_covered' => 'Kano, Kaduna, Katsina, Jigawa, Sokoto, Zamfara, Kebbi'
            ],
            [
                'id' => 5,
                'name' => 'South East Zonal Office',
                'location' => 'Enugu',
                'address' => '101 Enugu Street, Enugu, Enugu State, Nigeria',
                'phone' => '+234 805 678 9012',
                'email' => 'southeast@nihsa.gov.ng',
                'latitude' => 6.4500,
                'longitude' => 7.5000,
                'states_covered' => 'Enugu, Anambra, Imo, Abia, Ebonyi'
            ],
            [
                'id' => 6,
                'name' => 'South South Zonal Office',
                'location' => 'Port Harcourt',
                'address' => '202 Rivers Road, Port Harcourt, Rivers State, Nigeria',
                'phone' => '+234 806 789 0123',
                'email' => 'southsouth@nihsa.gov.ng',
                'latitude' => 4.8156,
                'longitude' => 7.0498,
                'states_covered' => 'Rivers, Bayelsa, Delta, Edo, Cross River, Akwa Ibom'
            ],
            [
                'id' => 7,
                'name' => 'South West Zonal Office',
                'location' => 'Lagos',
                'address' => '303 Lagos Avenue, Lagos, Lagos State, Nigeria',
                'phone' => '+234 807 890 1234',
                'email' => 'southwest@nihsa.gov.ng',
                'latitude' => 6.4550,
                'longitude' => 3.3841,
                'states_covered' => 'Lagos, Ogun, Oyo, Osun, Ondo, Ekiti'
            ]
        ];

        return view('contact.index', compact('zonalOffices'));
    }

    /**
     * Store a contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Save the contact message to the database
        Contact::create($validated);

        return redirect()->route('contact.index')->with('success', 'Your message has been sent successfully. We will get back to you soon.');
    }
}
