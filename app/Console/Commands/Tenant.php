<?php

namespace App\Console\Commands;

use App\Actions\TenantConnection;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class Tenant extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenant {instruction} {--tenant=}';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $db = 'company'.$this->options('tenant')['tenant'];
        foreach(
            User::cursor()
                ->all() as $user) {

                app(TenantConnection::class, [
                    'user' => $user
                ])->execute($db);

                Artisan::call($this->argument('instruction'), [], $this->output);
        }

        return self::SUCCESS;
    }
}
