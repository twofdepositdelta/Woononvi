<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Création des rôles avec les attributs 'role' pour le français et 'name' pour l'anglais
        Role::create(['role' => 'Super Administrateur', 'name' => 'super admin', 'guard_name' => 'web']);
        Role::create(['role' => 'Développeur', 'name' => 'developer', 'guard_name' => 'web']);
        Role::create(['role' => 'Gestionnaire', 'name' => 'manager', 'guard_name' => 'web']);
        Role::create(['role' => 'Commercial', 'name' => 'sales', 'guard_name' => 'web']);
        Role::create(['role' => 'Support', 'name' => 'support', 'guard_name' => 'web']);
        Role::create(['role' => 'Conducteur', 'name' => 'driver', 'guard_name' => 'web']);
        Role::create(['role' => 'Passager', 'name' => 'passenger', 'guard_name' => 'web']);

        Role::create(['role' => 'Conducteur', 'name' => 'driver', 'guard_name' => 'admin']);
        Role::create(['role' => 'Passager', 'name' => 'passenger', 'guard_name' => 'admin']);
    }
}