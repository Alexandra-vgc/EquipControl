<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UsersRolesSeeder extends Seeder
{
    public function run()
    {
        // Eliminar asignaciones anteriores de roles
        DB::table('model_has_roles')->truncate();

        // Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $lectorRole = Role::firstOrCreate(['name' => 'lector']);

        // Crear usuarios y asignar roles
        $userAdmin = User::updateOrCreate(
            ['email' => 'admin@tudominio.com'],
            ['name' => 'Admin', 'password' => bcrypt('adminadmin')]
        );
        $userAdmin->syncRoles([$adminRole]); // asegura que solo tenga ese rol

        
        $userEditor = User::updateOrCreate(
            ['email' => 'editor@tudominio.com'],
            ['name' => 'Editor', 'password' => bcrypt('editoreditor')]
        );
        $userEditor->syncRoles([$editorRole]);

        $userLector = User::updateOrCreate(
            ['email' => 'lector@tudominio.com'],
            ['name' => 'Lector', 'password' => bcrypt('lectorlector')]
        );
        $userLector->syncRoles([$lectorRole]);
    }
}
