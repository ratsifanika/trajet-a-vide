<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = ['brand', 'model', 'car_type', 'remarks', 'carrier_id'];

    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }
}
