<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tag_projects')->insert([
            [
                'name' => 'Пищёвка',
                'project_id' => 1
           ],[
                'name' => 'Стройка',
                'project_id' => 1
            ],[
                'name' => 'Авто',
                'project_id' => 3
            ]
        ]);

        $this->command->info('Таблица tag_projects заполнена.');
    }
}