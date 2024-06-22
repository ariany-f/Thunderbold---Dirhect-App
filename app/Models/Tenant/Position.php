<?php

namespace App\Models\Tenant;

use App\Models\Traits\TenantOwner;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    use TenantOwner;

    protected $fillable = [
        'name', 'base_salary',
    ];

    // Exemplo de relacionamento com funcionários
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
