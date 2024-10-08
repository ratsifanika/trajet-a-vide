<?php
namespace App\Http\Controllers;
use App\Models\Car;
use App\Models\City;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class RouteController
{
    public function create()
    {
        $carrier = auth()->user()->carrier;
        $cars = $carrier->cars;
        
        return Inertia::render('Routes/Create', [ 
            'cars' =>$cars->map(function (Car $car) {
                return [
                    'id' => $car->id,
                    'brand' => $car->brand,
                    'model' => $car->model,
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'departure_city_id' => 'required|exists:cities,id',
                'arrival_city_id' => 'required|exists:cities,id',
                'departure_date_time' => 'required|date',
                'price_per_passenger' => 'required|numeric',
                'available_seats' => 'required|integer',
                'car_id' => 'required|exists:cars,id',
            ]);
            $carrier = auth()->user()->carrier;
            $validated['carrier_id'] = $carrier->id;
            Route::create($validated); // Utilise les données validées
    
            return redirect()->route('home')->with('success', 'Trajet ajouté avec succès');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return Redirect::back()->withErrors($e->errors())->withInput();
        }
    }

    public function searchRoutes(Request $request)
    {
        $departureCityId = $request->departure_city_id;
        $arrivalCityId = $request->arrival_city_id;

        $routes = Route::where('departure_city_id', $departureCityId)
            ->where('arrival_city_id', $arrivalCityId)
            ->with('car', 'departureCity', 'arrivalCity')
            ->get();

        return response()->json(['routes' => $routes]);
    }
}