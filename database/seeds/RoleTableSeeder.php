<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'zinc', 'documents'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}
