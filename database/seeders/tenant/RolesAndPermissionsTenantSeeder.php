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
        $permissionsAdmin = [
            'documento',
            'genero',
            'nestudio',
            'tsolicitante',
            'barrio',
            'solicitudes',
            'roles',
            'permisos',
        ];
        $permissionsUser = [
            'formulario',
            'versolicitudes',
        ];

        // Crear los permisos
        foreach ($permissionsAdmin as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        foreach ($permissionsUser as $permission) {
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

        $userRole = Role::firstOrCreate([
            'name' => 'user',
            'guard_name' => 'web',
        ]);

        // Asignar todos los permisos al rol de administrador
        $adminRole->syncPermissions($permissionsAdmin);
        // Asignar todos los permisos al rol de administrador
        $userRole->syncPermissions($permissionsUser);

        // Crear el usuario administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
            ]
        );
        // Crear el usuario user
        $user = User::firstOrCreate(
            ['email' => 'usuario@gmail.com'],
            [
                'name' => 'Usuario',
                'password' => Hash::make('1q2w3e4r'),
                'email_verified_at' => now(),
            ]
        );

        // Asignar el rol de administrador al usuario
        $admin->assignRole('admin');
        $user->assignRole('user');

        // Crear un equipo para el Administrador
        $teamadmin = Team::firstOrCreate(
            ['user_id' => $admin->id, 'name' => 'Admin\'s Team'],
            [
                'personal_team' => true,
            ]
        );

        $teamuser = Team::firstOrCreate(
            ['user_id' => $user->id, 'name' => 'Usuario\'s Team'],
            [
                'personal_team' => true,
            ]
        );
    }
}
