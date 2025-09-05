<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // 1. Crear permisos específicos
        $permissions = [
            // Permisos generales
            'ver',
            'crear',
            'editar',
            'eliminar',
            
            // Permisos específicos para equipos
            'eliminar equipos',
            
            // Permisos específicos para editor
            'ver-historial',
            'registrar-entregas',
            'registrar-devoluciones',
            'generar-documentos',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Crear roles si no existen
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $editorRole = Role::firstOrCreate(['name' => 'editor']);
        $lectorRole = Role::firstOrCreate(['name' => 'lector']);

        // 3. Asignar TODOS los permisos al admin
        $adminRole->syncPermissions(Permission::all());

        // 4. Asignar permisos específicos al EDITOR
        $editorRole->syncPermissions([
            'ver',
            'crear',
            'ver-historial',
            'registrar-entregas', 
            'registrar-devoluciones',
            'generar-documentos',
        ]);

        // 5. Asignar permisos básicos al LECTOR
        $lectorRole->syncPermissions([
            'ver',
        ]);

        $this->command->info('✅ Roles y permisos configurados correctamente');
        $this->command->info('📋 Admin: Todos los permisos');
        $this->command->info('📝 Editor: ver, crear, ver-historial, registrar-entregas, registrar-devoluciones, generar-documentos');
        $this->command->info('👁️ Lector: solo ver');
    }
}