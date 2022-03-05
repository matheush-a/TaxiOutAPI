<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
        'step',
        'trip_id'
    ];

    public function trip() {
        return $this->belongsTo(Trip::class);
    }
}
