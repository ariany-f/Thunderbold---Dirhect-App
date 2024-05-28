<?php

namespace App\Models\Tenant;

use App\Models\Traits\TenantOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyGroup extends Model
{
    use HasFactory;
    use TenantOwner;

    protected $fillable = [
        'name',
    ];

    public function branches()
    {
        return $this->hasMany(CompanyBranch::class, 'group_id');
    }
}
