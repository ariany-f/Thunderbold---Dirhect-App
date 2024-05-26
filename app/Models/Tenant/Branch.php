<?php

namespace App\Models\Tenant;

use App\Models\Traits\TenantOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    use TenantOwner;
}
