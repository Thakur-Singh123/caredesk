<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyCompany extends Model
{
    use HasFactory;

    protected $table = 'policy_companies';

    protected $fillable = [
        'company_id',
        'name',
        'code',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class, 'insurance_company_id');
    }
}