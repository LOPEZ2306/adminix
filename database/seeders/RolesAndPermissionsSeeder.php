<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permisos = [
            'ver usuarios', 'crear usuarios', 'editar usuarios', 'eliminar usuarios',
            'ver productos', 'crear productos', 'editar productos', 'eliminar productos',
            'ver ventas', 'crear ventas', 'eliminar ventas',
            'ver abastecimientos', 'crear abastecimientos', 'eliminar abastecimientos',
            'ver categorías', 'crear categorías', 'editar categorías', 'eliminar categorías',
        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Rol admin con todos los permisos
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(Permission::all());

        // Rol vendedor con permisos específicos
        $vendedor = Role::firstOrCreate(['name' => 'vendedor']);
        $vendedor->syncPermissions([
            'ver productos', 'crear productos', 'editar productos',
            'ver ventas', 'crear ventas',
            'ver abastecimientos', 'crear abastecimientos',
            'ver categorías'
        ]);
    }
}
