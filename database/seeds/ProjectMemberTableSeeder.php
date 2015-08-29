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
        DB::table('project_members')->delete();

		DB::table('project_members')->insert([
		    ['project_id' => 10, 'member_id' => 1],
		    ['project_id' => 9, 'member_id' => 1],
		    ['project_id' => 9, 'member_id' => 2],
		    ['project_id' => 8, 'member_id' => 2]
		]);
    }
}
