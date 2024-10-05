<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function search(Request $request)
    {   
        
        // Rechercher les villes avec les trois premières lettres
        $cities = City::where('name', 'like', $request->query('query') . '%')->get();
        return response()->json(["cities" => $cities->toArray()]);
    }
}
