<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure_city_id', 
        'arrival_city_id', 
        'departure_date_time', 
        'price_per_passenger', 
        'available_seats', 
        'remarks', 
        'car_id',
        'carrier_id'
    ];

    public function departureCity()
    {
        return $this->belongsTo(City::class, 'departure_city_id');
    }

    public function arrivalCity()
    {
        return $this->belongsTo(City::class, 'arrival_city_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    // Relation avec les réservations
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
