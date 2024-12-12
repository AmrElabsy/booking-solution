<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
