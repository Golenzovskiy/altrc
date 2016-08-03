<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            [
                'name' => 'Volvo',
                'description' => 'Исследование рынка и рекомендации по наращиванию объемов продаж на российском рынке компании "Volvo Penta"',
                'year' => '2013-12-05',
                'logo' => '/logos/volvo.png',
                'created_at' => date('Y-m-d H-i-s'),
                'updated_at' => date('Y-m-d H-i-s')
           ],[
                'name' => 'Siemens',
                'description' => 'Оценка перспективности организации производства рентгено-диагностических оборудования в России для Siemens',
                'year' => '2016-05-12',
                'logo' => '/logos/siemens.jpg',
                'created_at' => date('Y-m-d H-i-s'),
                'updated_at' => date('Y-m-d H-i-s')
            ],[
                'name' => 'Oerlikon',
                'description' => 'Оценка потенциала развития на российском рынке в отраслях-потребителях всех бизнес-направлений компании Oerlikon Group',
                'year' => '2014-03-01',
                'logo' => '/logos/oerlikon.jpg',
                'created_at' => date('Y-m-d H-i-s'),
                'updated_at' => date('Y-m-d H-i-s')
            ]
        ]);

        $this->command->info('Таблица projects заполнена.');
    }
}