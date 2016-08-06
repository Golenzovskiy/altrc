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
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Project;
use App\Helpers\Helper;
use Symfony\Component\EventDispatcher\Tests\Service;

class ProjectController extends Controller
{

    /**
     * Index page
     */
    public function index(Request $request) {
        return view('index', [
            'services' => ServiceProject::dictionary(),
            'sectors' => SectorProject::dictionary(),
            'country' => CountryProject::dictionary(),
            'userReferences' => $request->session()->get('user.references') // добавляем в шаблон рефернеции из сессии пользователя
        ]);
    }

    /**
     * Create new project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
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
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:projects',
            'logo' => 'image',
        ]);

        $project = new Project;
        $project->name = $request->name;
        $project->year = $request->year . "-01-01";
        $project->description = $request->description;
        if ($request->logo) {
            $imgName = $request->file('logo')->getClientOriginalName();
            $request->file('logo')->move('images/logos', $imgName);
            $project->logo = '/logos/' . $imgName;
        }
        $project->save();

        $idProject = $project->id;

        $dictionaries = [
            'services' => '\App\ServiceProject',
            'sectors' => '\App\SectorProject',
            'country' => '\App\CountryProject'
        ];

        foreach ($dictionaries as $key => $value) {
            if ($request->$key) {
                $dictionary = new $value();
                $arr = $request->$key;
                $this->saveDictionary($dictionary, $arr, $idProject);
            }
        }

        var_dump($request);
        die;
    }

    private function saveDictionary($dictionary, $arr, $idProject)
    {
        $data = array();
        foreach ($arr as $value) {
            $data[] = array('name' => $value, 'project_id' => $idProject);
        }
        $dictionary->insert($data);
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $project = Project::find($id);
            $project->name = $request->name;
            $project->year = $request->year . "-01-01";
            $project->description = $request->description;
            $project->save();

            return $this->editView($id);
        } else {
            return $this->editView($id);
        }
    }

    private function editView($id)
    {
        $selectedServices = ServiceProject::where('project_id', '=', $id)->get();
        $allServices = ServiceProject::dictionary();

        return view('project.edit', [
            'project' => Project::find($id),
            'services' => ServiceProject::dictionary(),
            'selectedServices' => ServiceProject::where('project_id', '=', $id)->get(),
            'sectors' => SectorProject::dictionary(),
            'country' => CountryProject::dictionary()
        ]);
    }

    /**
     * @param Request $request request
     * @return Response
     */
    public function filter(Request $request)
    {
        if (!$request->isMethod('post')) {
            return Helper::jsonError('Произошла ошибка');
        }
        $model = new Project();
        $projects = $model->getByFilter($request);
        return response()->json([
            'status' => 'success',
            'result' => view('filter.result', ['projects' => $projects])->render(),
            'amount' => $projects->total()
        ]);
    }
}