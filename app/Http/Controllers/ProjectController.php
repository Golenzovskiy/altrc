<?php
/**
 * Controller for work with project
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App\Http\Controllers;

use App\CountryProject;
use App\ReferenceProject;
use App\ServiceProject;
use App\SectorProject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Project;
use App\Helpers\Helper;

class ProjectController extends Controller {

    /**
     * Index page
     */
    public function index() {
        return view('index', [
            'services' => ServiceProject::dictionary(),
            'sectors' => SectorProject::dictionary(),
            'country' => CountryProject::dictionary()
        ]);
    }

    /**
     * Create new project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('project.create', [
            'services' => ServiceProject::dictionary(),
            'sectors' => SectorProject::dictionary(),
            'country' => CountryProject::dictionary()
        ]);
    }

    /**
     * Save project
     * @param  Request $request request
     * @return Response
     */
    public function save(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255|unique:projects',
            'logo' => 'image',
        ]);

        $project = new Project;
        $project->name = $request->name;
        $project->year = $request->year . "-01-01";
        $project->save();

        $services = new ServiceProject;
        $data = array();
        foreach ($request->services as $value) {
            $data[] = array('name' => $value, 'project_id' => $project->id);
        }
        $services->insert($data);

        $sectors = new SectorProject;
        $data = array();
        foreach ($request->sectors as $value) {
            $data[] = array('name' => $value, 'project_id' => $project->id);
        }
        $sectors->insert($data);

        $countrys = new CountryProject;
        $data = array();
        foreach ($request->country as $value) {
            $data[] = array('name' => $value, 'project_id' => $project->id);
        }
        $countrys->insert($data);

        var_dump($request);die;
    }

    /**
     * @param Request $request request
     * @return Response
     */
    public function filter(Request $request) {
       if (!$request->isMethod('post')) {
            return Helper::jsonError('Произошла ошибка');
       }
       $model =  new Project();
       $projects = $model->getByFilter($request);
       return response()->json([
           'status' => 'success',
           'result' => view('filter.result', ['projects' => $projects])->render(),
           'amount' => $projects->total()
       ]);
    }
}