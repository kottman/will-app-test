<?php

namespace App\Console\Commands;

use App\ValueObjects\ConstantObjects\Roles;
use App\Models\User;
use Illuminate\Console\Command;

class AssignAdminRole extends Command
{
    protected $signature = 'admin-role:assign';

    protected $description = 'Create admin user';

    public function handle(): int
    {
        $user = User::where('email', config('admin-role-criteria.email'))->firstOrFail();
        $user->assignRole(Roles::ROLE_ADMIN);

        return Command::SUCCESS;
    }
}
