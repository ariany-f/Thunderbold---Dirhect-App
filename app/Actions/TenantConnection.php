<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class TenantConnection
{
    public function __construct(protected User $user)
    {
        //
    }

    public function execute($tenant): void
    {
        DB::purge('tenant');
        config()->set('database.connections.tenant.database', $tenant);

        DB::reconnect('tenant');
    }
}
