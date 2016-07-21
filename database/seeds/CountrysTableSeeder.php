<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('country_projects')->insert([
            [
                'name' => 'Россия и СНГ',
                'project_id' => 1
            ],[
                'name' => 'Китай',
                'project_id' => 1
            ],[
                'name' => 'Индия',
                'project_id' => 2
            ],[
                'name' => 'США',
                'project_id' => 2
            ],[
                'name' => 'Индонезия',
                'project_id' => 3
            ],[
                'name' => 'Бразилия',
                'project_id' => 3
            ],[
                'name' => 'Пакистан',
                'project_id' => 3
            ],[
                'name' => 'Нигерия',
                'project_id' => 3
            ],[
                'name' => 'Бангладеш',
                'project_id' => 3
            ]
        ]);

        $this->command->info('Таблица country_projects заполнена.');
    }
}