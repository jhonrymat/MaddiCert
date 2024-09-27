<?php

namespace Database\Seeders\tenant;

use Hash;
use App\Models\User;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos


        // Crear o asegurarse de que los permisos existen
        $permissions = [
            'documento',
            'genero',
            'nestudio',
            'tsolicitante',
            'barrio',
            'solicitudes',
        ];

        // Crear los permisos
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        // Crear o asegurarse de que el rol de administrador existe
        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        // Asignar todos los permisos al rol de administrador
        $adminRole->syncPermissions($permissions);

        // Crear el usuario administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'jhonrymat@gmail.com'],
            [
                'name' => 'jhon matoma',
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
            ]
        );

        // Asignar el rol de administrador al usuario
        $adminUser->assignRole('admin');

        // Crear un equipo para el usuario
        $team = Team::firstOrCreate(
            ['user_id' => $adminUser->id, 'name' => 'Jhon\'s Team'],
            [
                'personal_team' => true,
            ]
        );
    }
}
