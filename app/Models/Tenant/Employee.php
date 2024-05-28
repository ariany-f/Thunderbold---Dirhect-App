<?php

namespace App\Models\Tenant;

use App\Models\Traits\TenantOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use TenantOwner;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'manager' => 'boolean',
    ];

    protected $fillable = [
        'name',
        'email',
        'user_id',
        'group_id',
        'manager'
    ];

    public function company_branches()
    {
        return $this->belongsToMany(CompanyBranch::class, 'company_branch_employees');
    }
}
