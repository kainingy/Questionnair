<?php

class DatabaseSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();

        // Add calls to Seeders here
        $this->call('UsersTableSeeder');
        $this->call('QuestionnairsTableSeeder');
        $this->call('QuestionsTableSeeder');
//        $this->call('RolesTableSeeder');
//        $this->call('PermissionsTableSeeder');
    }

}