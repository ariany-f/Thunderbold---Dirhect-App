<?php

namespace App\Models\Tenant;

use App\Models\Traits\TenantOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranchEmployee extends Model
{
    use HasFactory;
    use TenantOwner;

    protected $fillable = [
        'employee_id',
        'branch_id'
    ];
}
