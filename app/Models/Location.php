<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'latitude', 'longitude'];

    public function isWithinCompanyLocation($latitude, $longitude, $radius = 100)
    {
        $distance = $this->calculateDistance($latitude, $longitude);
        return $distance <= $radius;
    }

    private function calculateDistance($latitude, $longitude)
    {
        $theta = $this->longitude - $longitude;
        $distance = sin(deg2rad($this->latitude)) * sin(deg2rad($latitude)) + cos(deg2rad($this->latitude)) * cos(deg2rad($latitude)) * cos(deg2rad($theta));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515 * 1609.344; // distance in meters
        return $distance;
    }
}
