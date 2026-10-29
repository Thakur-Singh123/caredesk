<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'customer_name',
        'contact_no',
        'address',
        'contact_person_name',
        'contact_person_number',
        'email_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function policies()
    {
        return $this->hasMany(Policy::class);
    }
}