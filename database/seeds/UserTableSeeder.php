<?php

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
        DB::table('users')->insert([
             'firstname' => 'Admin',
             'lastname' => 'Admin',
             'email' => 'admin@blog.test',
             'password' => bcrypt('secret'),
             'phone' => '+237698196943',
             'role' => 'ADMIN',
             'gender' => 'male'
         ]);

        DB::table('users')->insert([
             'firstname' => 'member1',
             'lastname' => 'member1',
             'email' => 'member1@blog.test',
             'password' => bcrypt('secret'),
             'phone' => '+237698196943',
             'role' => 'MEMBER',
             'gender' => 'male'
         ]);



    }
}
