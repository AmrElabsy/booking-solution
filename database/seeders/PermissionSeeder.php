<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
    
        Permission::truncate();
    
        DB::statement('ALTER TABLE permissions AUTO_INCREMENT = 1');
    
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        
        $components = [
            'role' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'user' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'driver' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'customer' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'vehicle_type' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'vehicle_model' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'vehicle' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'trip' => ['list', 'add', 'edit', 'delete', 'import_excel'],
            'booking' => ['list', 'add', 'edit', 'delete', 'import_excel'],
        ];
    
        // Create permissions for each component
        foreach ($components as $component => $permissions) {
            foreach ($permissions as $permission) {
                Permission::create([
                    'name' => "{$permission}_{$component}",
                    'guard_name' => "api"
                ]);
            }
        }
    }
}
