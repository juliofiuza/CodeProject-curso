<?php

use Illuminate\Database\Seeder;

class ProjectMemberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CodeProject\Entities\User::class)->create([
	        'project_id' => '10',
	        'member_id' => '1',
        ]);

        factory(\CodeProject\Entities\User::class)->create([
	        'project_id' => '9',
	        'member_id' => '1',
        ]);

        factory(\CodeProject\Entities\User::class)->create([
	        'project_id' => '9',
	        'member_id' => '2',
        ]);

        factory(\CodeProject\Entities\User::class)->create([
	        'project_id' => '8',
	        'member_id' => '2',
        ]);
    }
}
