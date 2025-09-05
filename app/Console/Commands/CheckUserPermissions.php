<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CheckUserPermissions extends Command
{
    /**
     * Nombre y firma del comando Artisan.
     *
     * @var string
     */
    protected $signature = 'permisos:check {email}';

    /**
     * Descripción del comando.
     *
     * @var string
     */
    protected $description = 'Muestra los roles y permisos de un usuario por su email';

    /**
     * Ejecuta el comando.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("No se encontró un usuario con el email: {$email}");
            return 1;
        }

        $this->info("Usuario: {$user->name} ({$user->email})");

        // Roles
        $roles = $user->getRoleNames();
        $this->info("Roles:");
        foreach ($roles as $role) {
            $this->line("- {$role}");
        }

        // Permisos
        $perms = $user->getAllPermissions();
        $this->info("Permisos:");
        foreach ($perms as $perm) {
            $this->line("- {$perm->name}");
        }

        return 0;
    }
}
