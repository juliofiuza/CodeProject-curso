<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserTableSeeder::class);
        $this->call(ClientTableSeeder::class);
        $this->call(ProjectTableSeeder::class);
        $this->call(ProjectNoteTableSeeder::class);
        $this->call('OauthClientsTableSeeder');
        $this->call('ProjectMembersTableSeeder');

        Model::reguard();

        $this->command->info('Bando de dados populado com sucesso!');
    }

}

class OauthClientsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('oauth_clients')->delete();

        DB::table('oauth_clients')->insert([
            ['id' => 'appid1', 'secret' => 'secret', 'name' => 'AngularAPP']
        ]);

    }
}

class ProjectMembersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('project_members')->delete();

        DB::table('project_members')->insert([
            ['project_id' => '10', 'member_id' => '1'],
            ['project_id' => '9', 'member_id' => '1'],
            ['project_id' => '9', 'member_id' => '2'],
            ['project_id' => '8', 'member_id' => '2']
        ]);

    }
}