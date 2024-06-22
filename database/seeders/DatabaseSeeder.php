<?php

namespace Database\Seeders;

use App\Models\Tenant\Employee;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        //Employee::factory(10)->create();

        // create permissions
        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'edit company']);
        Permission::create(['name' => 'delete company']);
        Permission::create(['name' => 'view company']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'edit user']);
        Permission::create(['name' => 'delete user']);
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create company branch']);
        Permission::create(['name' => 'edit company branch']);
        Permission::create(['name' => 'delete company branch']);
        Permission::create(['name' => 'view company branch']);
        Permission::create(['name' => 'create company group']);
        Permission::create(['name' => 'edit company group']);
        Permission::create(['name' => 'delete company group']);
        Permission::create(['name' => 'view company group']);
        Permission::create(['name' => 'create employee']);
        Permission::create(['name' => 'edit employee']);
        Permission::create(['name' => 'delete employee']);
        Permission::create(['name' => 'view employee']);
        Permission::create(['name' => 'create dependent']);
        Permission::create(['name' => 'edit dependent']);
        Permission::create(['name' => 'delete dependent']);
        Permission::create(['name' => 'view dependent']);
        Permission::create(['name' => 'create positions']);
        Permission::create(['name' => 'edit positions']);
        Permission::create(['name' => 'delete positions']);
        Permission::create(['name' => 'view positions']);
        Permission::create(['name' => 'create team']);
        Permission::create(['name' => 'edit team']);
        Permission::create(['name' => 'delete team']);
        Permission::create(['name' => 'view team']);

        $role1 = Role::create(['name' => 'Super-Admin']);
        $role1->givePermissionTo('create company');
        $role1->givePermissionTo('edit company');
        $role1->givePermissionTo('delete company');
        $role1->givePermissionTo('view company');
        $role1->givePermissionTo('create user');
        $role1->givePermissionTo('edit user');
        $role1->givePermissionTo('delete user');
        $role1->givePermissionTo('view user');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('create company branch');
        $role2->givePermissionTo('edit company branch');
        $role2->givePermissionTo('delete company branch');
        $role2->givePermissionTo('view company branch');
        $role2->givePermissionTo('create company group');
        $role2->givePermissionTo('edit company group');
        $role2->givePermissionTo('delete company group');
        $role2->givePermissionTo('view company group');
        $role2->givePermissionTo('create employee');
        $role2->givePermissionTo('edit employee');
        $role2->givePermissionTo('delete employee');
        $role2->givePermissionTo('view employee');
        $role2->givePermissionTo('create dependent');
        $role2->givePermissionTo('edit dependent');
        $role2->givePermissionTo('delete dependent');
        $role2->givePermissionTo('view dependent');
        $role2->givePermissionTo('create positions');
        $role2->givePermissionTo('edit positions');
        $role2->givePermissionTo('delete positions');
        $role2->givePermissionTo('view positions');

        $role3 = Role::create(['name' => 'rh']);
        $role3->givePermissionTo('create employee');
        $role3->givePermissionTo('edit employee');
        $role3->givePermissionTo('delete employee');
        $role3->givePermissionTo('view employee');
        $role3->givePermissionTo('create dependent');
        $role3->givePermissionTo('edit dependent');
        $role3->givePermissionTo('delete dependent');
        $role3->givePermissionTo('view dependent');
        $role3->givePermissionTo('create positions');
        $role3->givePermissionTo('edit positions');
        $role3->givePermissionTo('delete positions');
        $role3->givePermissionTo('view positions');

        $role4 = Role::create(['name' => 'employee']);
        $role4->givePermissionTo('view dependent');

        $role5 = Role::create(['name' => 'manager']);
        $role5->givePermissionTo('view dependent');
        $role5->givePermissionTo('view employee');
        $role5->givePermissionTo('create team');
        $role5->givePermissionTo('edit team');
        $role5->givePermissionTo('delete team');
        $role5->givePermissionTo('view team');
    }
}
