<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('service_projects')->insert([
            [
                'name' => 'Стратегический маркетинг',
                'project_id' => 1
           ],[
                'name' => 'Стратегия и развитие бизнеса',
                'project_id' => 2
            ],[
                'name' => 'Оргструктура и изменения',
                'project_id' => 2
            ],[
                'name' => 'Бенчмаркинг и зарубежные рынки',
                'project_id' => 3
            ]
        ]);

        $this->command->info('Таблица service_projects заполнена.');
    }
}