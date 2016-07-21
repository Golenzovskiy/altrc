<?php

use Illuminate\Database\Seeder;

class SectorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sector_projects')->insert([
            [
                'name' => 'FMCG и потребительские товары',
                'project_id' => 1
           ],[
                'name' => 'Добыча, сырье и материалы',
                'project_id' => 1
            ],[
                'name' => 'Ритейл, логистика и дистрибуция',
                'project_id' => 3
            ],[
                'name' => 'Машиностроение и инжиниринг',
                'project_id' => 2
            ],[
                'name' => 'Медицина и фармацевтика',
                'project_id' => 3
            ],[
                'name' => 'Строительство и стройматериалы',
                'project_id' => 2
            ],[
                'name' => 'Химия и энергетика',
                'project_id' => 2
            ],[
                'name' => 'Государственные органы и компании',
                'project_id' => 1
            ]
        ]);

        $this->command->info('Таблица sector_projects заполнена.');
    }
}