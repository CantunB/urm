<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class ProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'create_proveedores']);
        Permission::create(['name' => 'read_proveedores']);
        Permission::create(['name' => 'update_proveedores']);
        Permission::create(['name' => 'delete_proveedores']);

        $super_admin = Role::findByName('super-admin');
        $super_admin->givePermissionTo(['create_proveedores',
                        'read_proveedores',
                        'update_proveedores',
                        'delete_proveedores']);
    }
}
