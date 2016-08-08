<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    private $csvFileName = '/csv/projects.csv';

    public function run()
    {
        // получаем наш csv файлик
        // правильно было бы тут делать проверку на получены ли данные, но лара делает это за тебя
        // когда ты через seed запускаешь этот скрипт
        $csvData = file_get_contents(__DIR__ . $this->csvFileName);
        // разбиваем csv на массив строк, разделителем является конец строки PHP_EOL
        $lines = explode(PHP_EOL, $csvData);
        // будет содержать строку csv в виде масива
        $data = array();
        foreach ($lines as $line) {
            $data[] = str_getcsv($line, ',', '~'); // тильда в качестве экранирующего символа
        }

        // извлекает первое значение массива array и возвращает его
        // в нашем случае мы тем самым удаляем из массива описание полей
        array_shift($data);

        foreach ($data as $row) {

            if (empty($row)) continue;
            // для теста -> var_dump($row);
            // создали проект
            $projectId = DB::table('projects')->insertGetId(
                [
                    'company'       => $row[0],
                    'name'          => trim($row[1]),
                    'description'   => trim($row[2]),
                    'year'          => $row[3],
                    'logo'          => ($row[4]) ? "/logos/{$row[4]}" : '',
                    'created_at'    => date('Y-m-d H-i-s'),
                    'updated_at'    => date('Y-m-d H-i-s')
                ]);

            // получив ID проекта, заполняем связанные справочники
            if ($projectId) {

                // соотвествие название таблиц и позиции значений в csv
                // то есть в массиве со значениям у тегов будет позиция 5
                // у усулг позиция 6 и т.д.
                $list = [
                    'tag_projects'       => 5,
                    'service_projects'   => 6,
                    'sector_projects'    => 7,
                    'country_projects'   => 8,
                    'reference_projects' => 9
                ];

                foreach ($list as $tableName => $index) {
                    // если пустая ячейка, пропускаем
                    if (!$row[$index]) continue;

                    $items = explode(';', $row[$index]);
                    foreach ($items as $item) {
                        DB::table($tableName)->insert([
                            'name' => trim($item),
                            'project_id' => $projectId
                        ]);
                    }
                }
            }
        }

        $this->command->info('Проекты успешно импортированы');
    }
}