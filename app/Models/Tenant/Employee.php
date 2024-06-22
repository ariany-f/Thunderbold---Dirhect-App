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
        'birthdate',
        'group_id',
        'manager',
        'position_id'
    ];

    public function company_branches()
    {
        return $this->belongsToMany(CompanyBranch::class, 'company_branch_employees', 'employee_id', 'branch_id');
    }

    public function dependents()
    {
        return $this->hasMany(Dependent::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    
    public function managers()
    {
        return $this->belongsToMany(Employee::class, 'employee_manager', 'employee_id', 'manager_id');
    }

    public function teamMembers()
    {
        return $this->belongsToMany(Employee::class, 'employee_manager', 'manager_id', 'employee_id');
    }
}
