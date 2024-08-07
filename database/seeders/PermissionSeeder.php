<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::updateOrCreate(
            [
                'name' => 'admin',
            ],
            ['name' => 'admin']
        );
        $role_pimpinan = Role::updateOrCreate(
            [
                'name' => 'pimpinan',
            ],
            ['name' => 'pimpinan']
        );
        $role_kepela_staff = Role::updateOrCreate(
            [
                'name' => 'kepala-staff',
            ],
            ['name' => 'kepala-staff']
        );
        $role_staff = Role::updateOrCreate(
            [
                'name' => 'staff',
            ],
            ['name' => 'staff']
        );
        $view_dashboard = Permission::updateOrCreate(
            [
                'name' => 'view_dashboard',
            ],
            ['name' => 'view_dashboard']
        );
        $view_user = Permission::updateOrCreate(
            [
                'name' => 'view_user',
            ],
            ['name' => 'view_user']
        );
        $view_profile = Permission::updateOrCreate(
            [
                'name' => 'view_profile',
            ],
            ['name' => 'view_profile']
        );

        $role_admin->givePermissionTo($view_dashboard);
        $role_kepela_staff->givePermissionTo($view_dashboard);
        $role_pimpinan->givePermissionTo($view_dashboard);
        $role_admin->givePermissionTo($view_user);
        $role_admin->givePermissionTo($view_profile);

        $user_admin = User::find(1);
        $user_admin->assignRole('admin');

        $user_pimpinan = User::find(4);
        $user_pimpinan->assignRole('pimpinan');

        $user_kepala_staff = User::find(3);
        $user_kepala_staff->assignRole('kepala-staff');

        $user_staff = User::find(2);
        $user_staff->assignRole('staff');
    }
}
