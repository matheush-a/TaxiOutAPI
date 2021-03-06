<?php

namespace App\Models;

use App\Models\Scopes\CarScope;
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

    protected static function booted() {
        static::addGlobalScope(new CarScope);
    }

    public function store($data) {
        $instance = $this->newInstance($data);
        $instance->user()->associate(auth()->user());
        $instance->save();
        
        return $instance;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
