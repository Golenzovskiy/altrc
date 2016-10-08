<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use \App\Project;

class GetImgPathTest extends TestCase
{
    /**
     * @return void
     */
    public function testNotEmptyReturn()
    {
        $project = new Project;
        $this->assertNotEmpty($project->getImgPath(''), 'Пустой ответ.');
        return $project;
    }

    /**
     * @depends testNotEmptyReturn
     */
    public function testDirectoryExist($project)
    {
        $this->assertFileExists($project->getImgPath(''), 'Директории не существует.');
    }
}
