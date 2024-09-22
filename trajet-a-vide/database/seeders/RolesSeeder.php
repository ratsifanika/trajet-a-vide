<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $passenger = Role::create(['name' => 'passenger']);
        $carrier = Role::create(['name' => 'carrier']);
        $admin = Role::create(['name' => 'admin']);

        $editRoute = Permission::create(['name' => 'edit route']);
        $addCar = Permission::create(['name' => 'add car']);

        $permissions = [
            $editRoute,
            $addCar
        ];
        $carrier->syncPermissions($permissions);
    }
}
