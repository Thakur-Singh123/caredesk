<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function models()
    {
        return $this->hasMany(VehicleModel::class, 'make_id');
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}