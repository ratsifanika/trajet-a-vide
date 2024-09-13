<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}