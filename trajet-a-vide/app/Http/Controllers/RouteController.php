<?php
namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Route;
use Illuminate\Http\Client\Request;
use Inertia\Inertia;

class RouteController
{
    public function create()
    {
        $cities = City::all();
        $carrier = auth()->user()->carrier;
        $cars = $carrier->cars;
        
        // return view('route.create', compact('cities', 'cars'));
        return Inertia::render('Routes/Create', [
            'cities' => $cities, 
            'cars' =>$cars
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'departure_city_id' => 'required|exists:cities,id',
            'arrival_city_id' => 'required|exists:cities,id',
            'departure_date_time' => 'required|date',
            'price_per_passenger' => 'required|numeric',
            'available_seats' => 'required|integer',
            'car_id' => 'required|exists:cars,id',
        ]);

        Route::create($request->all());

        return redirect()->route('route.create')->with('success', 'Trajet ajouté avec succès');
    }
}