<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'view-dashboard',
            'create-booking',
            'update-room-status',
            'manage-users',
            'manage-accommodation-locations',
            'manage-accommodation-types',
            'manage-room-types',
            'manage-rooms',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign created permissions
        $role = Role::create(['name' => 'Resort Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Manager']);
        $role->givePermissionTo(['view-dashboard', 'create-booking', 'update-room-status', 'manage-users']);

        $role = Role::create(['name' => 'Front Desk']);
        $role->givePermissionTo(['view-dashboard', 'create-booking', 'update-room-status']);

        $role = Role::create(['name' => 'Housekeeper']);
        $role->givePermissionTo(['view-dashboard', 'update-room-status']);

        $role = Role::create(['name' => 'Maintenance']);
        $role->givePermissionTo(['view-dashboard', 'update-room-status']);
    }
}
