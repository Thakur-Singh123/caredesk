<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'owner_name',
        'email',
        'phone',
        'status',
    ];

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function makes()
    {
        return $this->hasMany(Make::class);
    }

    public function policyCompanies()
    {
        return $this->hasMany(PolicyCompany::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}