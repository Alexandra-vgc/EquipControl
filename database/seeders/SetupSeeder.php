<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SetupSeeder extends Seeder
{
    /**
     * Configuración inicial completa para EquipControl
     */
    public function run()
    {
        // 1. CREAR ROLES
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $lector = Role::firstOrCreate(['name' => 'lector']);

        // 2. CREAR PERMISOS (si los necesitas)
        $permisos = [
            'ver',
            'crear',
            'editar', 
            'eliminar',
            'ver-historial',
            'eliminar equipos'
        ];

        foreach($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // 3. CREAR USUARIOS POR DEFECTO

        // Usuario Administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@equipcontrol.com'],
            [
                'name' => 'Administrador Sistema',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now()
            ]
        );
        
        if (!$adminUser->hasRole('admin')) {
            $adminUser->assignRole('admin');
        }

        // Usuario Editor
        $editorUser = User::firstOrCreate(
            ['email' => 'editor@equipcontrol.com'],
            [
                'name' => 'Editor Sistema',
                'password' => Hash::make('editor123'),
                'email_verified_at' => now()
            ]
        );
        
        if (!$editorUser->hasRole('editor')) {
            $editorUser->assignRole('editor');
        }

        // Usuario Lector
        $lectorUser = User::firstOrCreate(
            ['email' => 'lector@equipcontrol.com'],
            [
                'name' => 'Lector Sistema',
                'password' => Hash::make('lector123'),
                'email_verified_at' => now()
            ]
        );
        
        if (!$lectorUser->hasRole('lector')) {
            $lectorUser->assignRole('lector');
        }

        $this->command->info('✅ Configuración completada exitosamente!');
        $this->command->info('📧 Usuarios creados:');
        $this->command->info('   Admin: admin@equipcontrol.com / admin123');
        $this->command->info('   Editor: editor@equipcontrol.com / editor123');  
        $this->command->info('   Lector: lector@equipcontrol.com / lector123');
    }
}