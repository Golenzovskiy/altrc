<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    private $csvFileName = '/path';

    public function run()
    {
        $csvData = file_get_contents($this->csvFileName);
        $lines = explode(PHP_EOL, $csvData);
        $data = array();
        foreach ($lines as $line) {
            $data[] = str_getcsv($line);
        }
        dd($data);

        foreach ($data as $row) {
            if (empty($row)) continue;

            $projectId = DB::table('projects')->insertGetId(
                [
                    'name' => $row[0],
                    'description' => $row[1],
                    'year' => $row[2],
                    'logo' => "/logos/{$row[3]}",
                    'created_at' => date('Y-m-d H-i-s'),
                    'updated_at' => date('Y-m-d H-i-s')
                ]);

            if ($projectId) {
                $countries = explode(';', $row[4]);
                foreach ($countries as $country) {
                    DB::table('country_projects')->insert([
                        'name' => $country,
                        'project_id' => $projectId
                    ]);
                }
            }
        }

        /*DB::table('projects')->insert([
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
        ]);*/

        $this->command->info('Таблица projects заполнена.');
    }
}