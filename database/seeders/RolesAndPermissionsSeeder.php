<?php

namespace Database\Seeders;

use Hash;
use App\Models\User;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'users',
            'tenants'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $adminRole = Role::firstOrCreate(['name' => 'super-administrador']);

        // Asignar permisos al rol de administrador
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
        $adminUser->assignRole('super-administrador');

        // Crear un equipo para el usuario
        $team = Team::firstOrCreate(
            ['user_id' => $adminUser->id, 'name' => 'Jhon\'s Team'],
            [
                'personal_team' => true,
            ]
        );
    }
}
