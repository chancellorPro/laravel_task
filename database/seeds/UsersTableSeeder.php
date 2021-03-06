<?php

use Illuminate\Database\Seeder;
use App\User;

/**
 * Class UsersSeeder
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'admin',
            'email' => 'admin@admin.admin',
            'password' => bcrypt('admin'),
            'avatar' => 'avatar',
        ]);
    }
}