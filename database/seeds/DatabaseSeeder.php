<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProjectsTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(ReferencesTableSeeder::class);
        $this->call(SectorsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(TagsTableSeeder::class);
    }
}