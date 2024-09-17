@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajouter un trajet</h2>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('route.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="departure_city_id" class="form-label">Ville de départ</label>
            <select class="form-control" id="departure_city_id" name="departure_city_id" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="arrival_city_id" class="form-label">Ville d'arrivée</label>
            <select class="form-control" id="arrival_city_id" name="arrival_city_id" required>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="departure_date_time" class="form-label">Date et heure de départ</label>
            <input type="datetime-local" class="form-control" id="departure_date_time" name="departure_date_time" required>
        </div>
        <div class="mb-3">
            <label for="price_per_passenger" class="form-label">Prix par passager</label>
            <input type="number" class="form-control" id="price_per_passenger" name="price_per_passenger" required>
        </div>
        <div class="mb-3">
            <label for="available_seats" class="form-label">Nombre de places disponibles</label>
            <input type="number" class="form-control" id="available_seats" name="available_seats" required>
        </div>
        <div class="mb-3">
            <label for="car_id" class="form-label">Voiture</label>
            <select class="form-control" id="car_id" name="car_id" required>
                @foreach($cars as $car)
                    <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}</option>
                @endforeach
            </select>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addCarModal">
                Ajouter une voiture
            </button>
        </div>
        <div class="mb-3">
            <label for="remarks" class="form-label">Remarques</label>
            <textarea class="form-control" id="remarks" name="remarks"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>

    

</div>

<!-- Modal pour ajouter une nouvelle voiture -->
<div class="modal fade" id="addCarModal" tabindex="-1" aria-labelledby="addCarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCarModalLabel">Ajouter une nouvelle voiture</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addCarForm" hx-post="{{ route('car.store') }}" hx-target="#car" hx-swap="outerHTML">
                    @csrf
                    <div class="form-group">
                        <label for="car-name">Nom de la voiture</label>
                        <input type="text" name="brand" id="car-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="car-image">Image de la voiture</label>
                        <input type="file" name="image" id="car-image" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection