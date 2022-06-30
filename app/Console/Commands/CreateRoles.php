<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateRoles extends Command
{
    protected $signature = 'roles:create';

    protected $description = 'Create roles';

    public function handle(): int
    {
        Artisan::call('permission:create-role admin web');

        return Command::SUCCESS;
    }
}
