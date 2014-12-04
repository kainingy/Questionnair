<?php

class QuestionnairsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('questionnairs')->delete();

        $user_id = User::first()->id;

        DB::table('questionnairs')->insert( array(
            array(
                'user_id'    => $user_id,
                'title'      => 'Lorem ipsum dolor sit amet',
                'slug'       => 'lorem-ipsum-dolor-sit-amet',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id'    => $user_id,
                'title'      => 'Vivendo suscipiantur vim te vix',
                'slug'       => 'vivendo-suscipiantur-vim-te-vix',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'user_id'    => $user_id,
                'title'      => 'In iisque similique reprimique eum',
                'slug'       => 'in-iisque-similique-reprimique-eum',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ))
        );
    }

}
