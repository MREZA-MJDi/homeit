<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'Super Admin',
            'Admin',
            'Support',
            'Technician',
            'Customer'];

        $permissions = [
            //Users
            'user.view',
            'user.create',
            'user.update',
            'user.delete',
            // Services
            'service.view',
            'service.create',
            'service.update',
            'service.delete',

            // Orders
            'order.view',
            'order.create',
            'order.update',
            'order.cancel',

            // Reviews
            'review.view',
            'review.create',
            'review.update',
            'review.delete',

            // Wallet
            'wallet.view',
            'wallet.charge',
            'wallet.withdraw',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => $permission,]);
        }
        foreach ($roles as $role) {
            Role::firstOrCreate([
                'name' => $role,
                'guard_name' => 'web',
            ]);
    }
        Role::findByName('Admin')->syncPermissions(['user.view',
            'user.create',
            'user.update',
            'user.delete',

            'service.view',
            'service.create',
            'service.update',
            'service.delete',

            'order.view',
            'order.create',
            'order.update',
            'order.cancel',

            'review.view',
            'review.create',
            'review.update',
            'review.delete',

            'wallet.view',
            'wallet.charge',
            'wallet.withdraw',]);
}}
