<?php

namespace Modules\Domain\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class SeedRolesTableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    
        Role::truncate();
    
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');
    
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    
        $roles = [
            'Manager',
            'Admin',
            'Driver',
            'Customer',
        ];
    
        foreach ($roles as $role) {
            Role::create(['name' => $role, 'guard_name' => 'api']);
        }
    }
}
