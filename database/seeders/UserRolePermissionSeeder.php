<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
//run : php artisan db:seed --class=UserRolePermissionSeeder
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make ('12345678'),
        ]);


        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make ('12345678'),
        ]);

        $staffUser = User::firstOrCreate([
            'email' => 'staff@gmail.com',
        ], [
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('12345678'),
        ]);


        // Create Permissions
        Permission::create(['name' => 'role management']);
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);


        Permission::create(['name' => 'company management']);
        Permission::create(['name' => 'view company']);
        Permission::create(['name' => 'create company']);
        Permission::create(['name' => 'update company']);
        Permission::create(['name' => 'delete company']);

        Permission::create(['name' => 'view branch']);
        Permission::create(['name' => 'create branch']);
        Permission::create(['name' => 'update branch']);
        Permission::create(['name' => 'delete branch']);


        Permission::create(['name' => 'view store']);
        Permission::create(['name' => 'create store']);
        Permission::create(['name' => 'update store']);
        Permission::create(['name' => 'delete store']);


        Permission::create(['name' => 'product management']);
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);


        Permission::create(['name' => 'view manufacture']);
        Permission::create(['name' => 'create manufacture']);
        Permission::create(['name' => 'update manufacture']);
        Permission::create(['name' => 'delete manufacture']);

        Permission::create(['name' => 'view unit']);
        Permission::create(['name' => 'create unit']);
        Permission::create(['name' => 'update unit']);
        Permission::create(['name' => 'delete unit']);

        Permission::create(['name' => 'view size']);
        Permission::create(['name' => 'create size']);
        Permission::create(['name' => 'update size']);
        Permission::create(['name' => 'delete size']);


        Permission::create(['name' => 'view color']);
        Permission::create(['name' => 'create color']);
        Permission::create(['name' => 'update color']);
        Permission::create(['name' => 'delete color']);


        Permission::create(['name' => 'view child_category']);
        Permission::create(['name' => 'create child_category']);
        Permission::create(['name' => 'update child_category']);
        Permission::create(['name' => 'delete child_category']);

        Permission::create(['name' => 'view sub_category']);
        Permission::create(['name' => 'create sub_category']);
        Permission::create(['name' => 'update sub_category']);
        Permission::create(['name' => 'delete sub_category']);

        Permission::create(['name' => 'view category']);
        Permission::create(['name' => 'create category']);
        Permission::create(['name' => 'update category']);
        Permission::create(['name' => 'delete category']);

        Permission::create(['name' => 'view brand']);
        Permission::create(['name' => 'create brand']);
        Permission::create(['name' => 'update brand']);
        Permission::create(['name' => 'delete brand']);

        Permission::create(['name' => 'people management']);

        Permission::create(['name' => 'view suppliers']);
        Permission::create(['name' => 'create suppliers']);
        Permission::create(['name' => 'update suppliers']);
        Permission::create(['name' => 'delete suppliers']);

        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);



//        Permission::create(['name' => 'people management']);




        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $userRole = Role::create(['name' => 'user']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create role', 'view role', 'update role']);
        $adminRole->givePermissionTo(['create permission', 'view permission']);
        $adminRole->givePermissionTo(['create user', 'view user', 'update user']);
        $adminRole->givePermissionTo(['create product', 'view product', 'update product']);


        // Let's Create User and assign Role to it.



        $superAdminUser->assignRole($superAdminRole);



        $adminUser->assignRole($adminRole);




        $staffUser->assignRole($staffRole);
    }
}
