<?php

namespace Database\Seeders\tenant;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar al seeder que quieres agregar
        $this->call(RolesAndPermissionsTenantSeeder::class);
    }
}
