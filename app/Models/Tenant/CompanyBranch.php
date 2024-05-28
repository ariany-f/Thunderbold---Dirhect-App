<?php

namespace App\Models\Tenant;

use App\Models\Traits\TenantOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;
    use TenantOwner;

    protected $fillable = [
        'name',
        'group_id'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'company_branch_employees');
    }

    // Define the relationship with CompanyGroup
    public function companyGroup()
    {
        return $this->belongsTo(CompanyGroup::class, 'group_id');
    }
}
