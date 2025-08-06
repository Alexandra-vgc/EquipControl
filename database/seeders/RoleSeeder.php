<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Role::create(['name' => 'admin1']);
    Role::create(['name' => 'admin2']);
    Role::create(['name' => 'encargado']);
    Role::create(['name' => 'usuario']);
    }
}
