<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $table = 'policies';

    protected $fillable = [
        'company_id',
        'branch_id',
        'customer_id',
        'make_id',
        'model_id',
        'insurance_company_id',
        'variant',
        'registration_no',
        'chassis_no',
        'engine_no',
        'manufacturing_year',
        'registration_date',
        'fuel',
        'cubic_capacity',
        'hypothecation',
        'booking_code',
        'policy_number',
        'policy_start_date',
        'policy_end_date',
        'tp_insurance_company',
        'tp_policy_number',
        'tp_policy_start_date',
        'tp_end_date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function vehicleModel()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    public function insuranceCompany()
    {
        return $this->belongsTo(PolicyCompany::class, 'insurance_company_id');
    }
}