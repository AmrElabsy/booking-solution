<?php

namespace Modules\Domain\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DomainDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SeedRolesTableTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserSeederTableSeeder::class);
        $this->call(RoleHasPermissionsTableSeeder::class);
    }
}
