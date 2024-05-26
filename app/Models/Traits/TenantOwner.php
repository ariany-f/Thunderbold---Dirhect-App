<?php

namespace App\Models\Traits;

trait TenantOwner
{
    public function getConnectionName(): string
    {
        return 'tenant';
    }
}
