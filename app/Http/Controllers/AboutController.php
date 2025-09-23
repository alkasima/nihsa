<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZonalOffice;

class AboutController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('about.index');
    }

    /**
     * Display the functions of the agency page.
     *
     * @return \Illuminate\Http\Response
     */
    public function functions()
    {
        return view('about.functions');
    }

    /**
     * Display the management page.
     *
     * @return \Illuminate\Http\Response
     */
    public function management()
    {
        return view('about.management');
    }

    /**
     * Display the organizational structure page.
     *
     * @return \Illuminate\Http\Response
     */
    public function structure()
    {
        return view('about.structure');
    }

    /**
     * Display the area and field offices page.
     *
     * @return \Illuminate\Http\Response
     */
    public function offices()
    {
        // In a real implementation, we would fetch data from the database
        // $zonalOffices = ZonalOffice::all();

        return view('about.offices');
    }

    /**
     * Display the history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        return view('about.history');
    }
}
