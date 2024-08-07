<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(
            [
                'name' => 'admin',
            ],
            ['name' => 'admin']
        );
        Role::updateOrCreate(
            [
                'name' => 'pimpinan',
            ],
            ['name' => 'pimpinan']
        );
        Role::updateOrCreate(
            [
                'name' => 'kepala-staff',
            ],
            ['name' => 'kepala-staff']
        );
        Role::updateOrCreate(
            [
                'name' => 'staff',
            ],
            ['name' => 'staff']
        );
    }
}
