<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        Permission::firstOrCreate(['name' => 'ver']);
        Permission::firstOrCreate(['name' => 'crear']);
        Permission::firstOrCreate(['name' => 'editar']);
        Permission::firstOrCreate(['name' => 'eliminar']);
    }
}
