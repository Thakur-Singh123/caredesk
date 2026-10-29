<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class VehicleModel extends EloquentModel
{
    use HasFactory;

    protected $table = 'models';

    protected $fillable = [
        'make_id',
        'name',
    ];

    public function make()
    {
        return $this->belongsTo(Make::class, 'make_id');
    }

    public function policies()
    {
        return $this->hasMany(Policy::class, 'model_id');
    }
}