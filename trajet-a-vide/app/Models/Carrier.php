<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone_number', 'email'];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }
}