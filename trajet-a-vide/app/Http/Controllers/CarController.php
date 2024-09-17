<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function store(Request $request)
{
    // Valider et créer une nouvelle voiture
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
    ]);

    $car = new Car();
    $car->brand = $validated['brand'];
    
    if ($request->hasFile('image')) {
        // Stocker l'image (par exemple, dans le dossier storage/app/public/cars)
        $path = $request->file('image')->store('cars', 'public');
        $car->image = $path;
    }
    
    // Associer la voiture au transporteur (Carrier)
    $car->carrier_id = auth()->user()->carrier->id;
    $car->save();

    // Renvoyer la liste des voitures mise à jour (en HTML)
    $cars = Car::where('carrier_id', auth()->user()->carrier->id)->get();

    return view('partials.car-options', compact('cars'));
}
}
