<?php

namespace Modules\Domain\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $user = User::create([
            'id' => 1,
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
            'first_name' => 'admin',
            'last_name' => 'admin',
        ]);
        
        $user->syncRoles(['Admin']);
    }
}