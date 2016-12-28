<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment(['local']) && ! User::where('username', 'test')->exists()) {
            factory(User::class)->create([
                'username' => 'test',
                'password' => bcrypt('test'),
            ])->roles()->saveMany(Role::all());
        }
    }
}
