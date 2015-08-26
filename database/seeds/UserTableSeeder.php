<?php

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
        factory(\CodeProject\Entities\User::class)->create([
	        'name' => 'Julio',
	        'email' => 'spinell@gmail.com',
	        'password' => bcrypt('lerolero'),
	        'remember_token' => str_random(10),
        ]);

        factory(\CodeProject\Entities\User::class, 10)->create();
    }
}
