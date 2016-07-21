<?php

use Illuminate\Database\Seeder;

class ReferencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reference_projects')->insert([
            [
                'name' => 'Исследование рынка и рекомендации по наращиванию объемов продаж на российском рынке компании "Volvo Penta"',
                'project_id' => 1
           ],[
                'name' => 'Оценка перспективности организации производства рентгено-диагностических оборудования в России',
                'project_id' => 2
            ],[
                'name' => 'Оценка потенциала развития на российском рынке в отраслях-потребителях всех бизнес-направлений компании',
                'project_id' => 3
            ]
        ]);

        $this->command->info('Таблица reference_projects заполнена.');
    }
}