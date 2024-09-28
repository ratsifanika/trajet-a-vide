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
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'image' => 'nullable|image', // Validation de l'image
        ]);

        // Création de la voiture
        $user = auth()->user();
        $carrier = $user->carrier;

        $car = new Car([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
        ]);

        // Associer la voiture au transporteur
        $carrier->cars()->save($car);

        // Si une image est fournie, on la sauvegarde
        if ($request->hasFile('image')) {
            // Stockage de l'image
            $imagePath = $request->file('image')->store('cars');

            // Enregistrement de l'image dans la table car_images
            $car->images()->create([
                'image_path' => $imagePath,
            ]);
        }

        return back()->with('success', 'Voiture et première image ajoutées avec succès!');
    }
}
