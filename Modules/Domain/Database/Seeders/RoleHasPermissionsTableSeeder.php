<?php

namespace Modules\Domain\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
    
        $adminRole = Role::where('name', 'Admin')->first();
    
        if ( $adminRole ) {
            $permissions = Permission::pluck('id')->toArray();
        
            $adminRole->syncPermissions($permissions);
        }
    }
}
