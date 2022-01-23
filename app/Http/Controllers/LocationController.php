<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
    public function importLocations()
    {
        if (Location::count() == 0) {
            foreach (json_decode(Storage::disk('local')->get('cities.json'), true) as $key => $value) {
                $district = Location::create([
                    'location' => $key
                ]);

                foreach ($value['cities'] as $key1 => $value1) {
                    Location::create([
                        'location' => $value1,
                        'main' => $district->id
                    ]);
                }
            }
        }
    }
}
