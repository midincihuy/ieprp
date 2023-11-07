<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Reset cached roles and permissions
      app()['cache']->forget('spatie.permission.cache');
      $permissions = array(
        'configuration_manage',
        'ticket_manage',
        'main_menu',
      );
      foreach ($permissions as $key => $value) {
        Permission::create(['name' => $value]);
      }

      $role = Role::create(['name' => 'administrator']);
      foreach ($permissions as $key => $value) {
        $role->givePermissionTo($value);
      }
      
    }
}
