<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $permission_admin = Permission::create(['name' => 'home.view', 'guard_name' => 'admin']);
        $permission_custromer = Permission::create(['name' => 'home.view']);

        $admin_role = Role::create(['name' => 'admin', 'guard_name' => 'admin'])->givePermissionTo($permission_admin);
        $manager_role = Role::create(['name' => 'manager', 'guard_name' => 'admin'])->givePermissionTo($permission_admin);
        $customer_role = Role::create(['name' => 'customer'])->givePermissionTo($permission_custromer);

        $customer = User::create([
            'name' => "Customer",
            'email' => "customer@multiauth.com",
            'password' => Hash::make('customer-password'),
        ]);
        $customer->assignRole('customer');

        $admin = Admin::create([
            'name' => "Admin",
            'email' => "admin@multiauth.com",
            'password' => Hash::make('admin-password'),
        ]);
        $admin->assignRole('admin');

        $manager = Admin::create([
            'name' => "Manager",
            'email' => "manager@multiauth.com",
            'password' => Hash::make('manager-password'),
        ]);
        $manager->assignRole('manager');

    }
}
