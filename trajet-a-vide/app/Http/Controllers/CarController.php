<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function store(Request $request)
    {
         // Validation des données
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image', // Si tu veux gérer l'image de la voiture
        ]);

        // Création de la nouvelle voiture pour le transporteur connecté
        $user = auth()->user();
        $carrier = $user->carrier;

        $car = new Car([
            'name' => $validated['name'],
        ]);

        if ($request->hasFile('image')) {
            $car->image = $request->file('image')->store('cars');
        }

        // Associer la voiture au transporteur
        $carrier->cars()->save($car);

        return back()->with('success', 'Voiture ajoutée avec succès!');
    }
}
