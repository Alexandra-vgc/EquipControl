<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UsersRolesSeeder extends Seeder
{
    public function run()
    {
        $adminRole  = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $lectorRole = Role::firstOrCreate(['name' => 'lector']);

        $userAdmin = User::firstOrCreate(
            ['email' => 'admin@tudominio.com'],
            ['name' => 'Admin', 'password' => bcrypt('adminadmin')]
        );
        $userAdmin->assignRole($adminRole);

        $userEditor = User::firstOrCreate(
            ['email' => 'editor@tudominio.com'],
            ['name' => 'Editor', 'password' => bcrypt('editoreditor')]
        );
        $userEditor->assignRole($editorRole);

        $userLector = User::firstOrCreate(
            ['email' => 'lector@tudominio.com'],
            ['name' => 'Lector', 'password' => bcrypt('lectorlector')]
        );
        $userLector->assignRole($lectorRole);
    }
}
