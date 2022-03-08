<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'color',
        'model',
        'plate',
        'seats',
        'user_id',
        'year',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}