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
use App\TagProject;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Project;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Symfony\Component\EventDispatcher\Tests\Service;

class ProjectController extends Controller
{

    /**
     * Index page
     */
    public function index(Request $request)
    {
        return view('index', [
            'path' => $request->path(),
            'services' => ServiceProject::dictionary(),
            'sectors' => SectorProject::dictionary(),
            'country' => CountryProject::dictionary(),
            'filter' => $request->session()->get('user.filter'),
            'isFilterSet' => $request->session()->has('user.filter'),
            'userReferences' => $request->session()->get('user.references'), // добавляем в шаблон рефернеции из сессии пользователя
            'amountDisplayProjects' => $request->session()->get('user.filter.amountDisplayProjects'),
        ]);
    }

    /**
     * Reset page
     */
    public function reset(Request $request) {
        if ($request->session()->has('user.filter')) {
            $request->session()->forget('user.filter');
        }
        return redirect()->action('ProjectController@index');
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
            'company' => 'required|max:255|unique:projects',
            'logo' => 'image',
            'references' => 'array_filled',
        ]);

        $project = new Project;
        $project->company = $request->company;
        $project->company_alternative = $request->company_alternative;
        $project->name = $request->name;
        $project->year = $request->year . "-01-01";
        $project->description = $request->description;
        if ($request->review == 'on') {
            $project->review = 1;
        } else {
            $project->review = 0;
        }
        if ($request->logo) {
            $imgName = pathinfo($request->file('logo')->getClientOriginalName())['filename'];
            if (glob($project->getImgPath(Project::ORIGIN_DIR) . $imgName . ".*")) {
                $imgExtension =$request->file('logo')->getClientOriginalExtension();
                $i = count(glob($project->getImgPath(Project::ORIGIN_DIR) . $imgName . "_*.*"));
                $img = $imgName . '_' . ++$i . '.' . $imgExtension;
                $request->file('logo')->move(($project->getImgPath(Project::ORIGIN_DIR)), $img);
            } else {
                $img = $request->file('logo')->getClientOriginalName();
                $request->file('logo')->move(($project->getImgPath(Project::ORIGIN_DIR)), $img);
            }
            $project->logo = '/logos/' . $img;
        }

        $project->save();
        $idProject = $project->id;

        if ($request->tags) {
            $tags = explode(',', $request->tags);
            $dictionary = new TagProject();
            $arr = $tags;
            $this->saveDictionary($dictionary, $arr, $idProject);
        }

        $dictionaries = [
            'services' => '\App\ServiceProject',
            'sectors' => '\App\SectorProject',
            'country' => '\App\CountryProject',
            'references' => '\App\ReferenceProject'
        ];

        foreach ($dictionaries as $key => $value) {
            if ($request->$key) {
                $dictionary = new $value();
                $arr = $request->$key;
                $this->saveDictionary($dictionary, $arr, $idProject);
            }
        }

        return redirect()->action('ProjectController@edit', $idProject);
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
        $this->validate($request, [
            'logo' => 'image',
            'references' => 'array_filled',
        ]);

        if ($request->isMethod('post')) {
            $project = Project::find($id);
            $project->company = $request->company;
            $project->company_alternative = $request->company_alternative;
            $project->name = $request->name;
            $project->year = $request->year . "-01-01";
            $project->description = $request->description;
            if ($request->review == 'on') {
                $project->review = 1;
            } else {
                $project->review = 0;
            }
            if ($request->logo) {
                $imgName = pathinfo($request->file('logo')->getClientOriginalName())['filename'];
                if (glob($project->getImgPath(Project::ORIGIN_DIR) . $imgName . ".*")) {
                    $imgExtension =$request->file('logo')->getClientOriginalExtension();
                    $i = count(glob($project->getImgPath(Project::ORIGIN_DIR) . $imgName . "_*.*"));
                    $img = $imgName . '_' . ++$i . '.' . $imgExtension;
                    $request->file('logo')->move(($project->getImgPath(Project::ORIGIN_DIR)), $img);
                } else {
                    $img = $request->file('logo')->getClientOriginalName();
                    $request->file('logo')->move(($project->getImgPath(Project::ORIGIN_DIR)), $img);
                }
                $project->logo = '/logos/' . $img;
            }

            $project->save();

            ServiceProject::DeleteByProject($id);
            SectorProject::DeleteByProject($id);
            CountryProject::DeleteByProject($id);
            TagProject::DeleteByProject($id);
            ReferenceProject::DeleteByProject($id);

            $tags = explode(',', $request->tags);
            if ($request->tags) {
                $dictionary = new TagProject();
                $arr = $tags;
                $this->saveDictionary($dictionary, $arr, $id);
            }

            $dictionaries = [
                'services' => '\App\ServiceProject',
                'sectors' => '\App\SectorProject',
                'country' => '\App\CountryProject',
                'references' => '\App\ReferenceProject'
            ];

            foreach ($dictionaries as $key => $value) {
                if ($request->$key) {
                    $dictionary = new $value();
                    $arr = $request->$key;
                    $this->saveDictionary($dictionary, $arr, $id);
                }
            }

            return redirect()->action('ProjectController@index');
        } else {
            return $this->editView($id);
        }
    }

    private function editView($id)
    {
        $data = \Cache::remember('project_' . $id, 1, function () use ($id) {
            return
            [
                'project' => Project::find($id),
                'services' => ServiceProject::dictionary(),
                'selectedServices' => ServiceProject::where('project_id', '=', $id)->get(),
                'sectors' => SectorProject::dictionary(),
                'selectedSectors' => SectorProject::where('project_id', '=', $id)->get(),
                'country' => CountryProject::dictionary(),
                'selectedCountrys' => CountryProject::where('project_id', '=', $id)->get(),
                'selectedTags' => TagProject::where('project_id', '=', $id)->get()
            ];
        });
        return view('project.edit', $data);
    }

    public function remove($id) {
        $count = Project::destroy($id);
        $status = ($count > 0) ? 'success' : 'error';
        return response()->json([
            'status' => $status,
            'message' => ($status == 'success') ? 'Проект успешно удален' : 'При попытке удалить проект произошла ошибка'
        ]);
    }

    /**
     * @param Request $request request
     * @return Response
     */
    public function filter(Request $request) {
        if (!$request->isMethod('post')) {
            return Helper::jsonError('Произошла ошибка');
        }
        $model = new Project();
        $result = $model->getByFilter($request);

        // записываем значения фильтра в сессию
        $request->session()->put('user.filter', $request->all());

        $projects = $result['projects'];
        $tags = $result['tags'];

        return response()->json([
            'status' => 'success',
            'result' => view('filter.result', [
                'projects' => $projects,
                'tags' => $tags,
                'userReferences' => $request->session()->get('user.references'),
                'amountDisplayProjects' => $request->session()->get('user.filter.amountDisplayProjects'),
            ])->render(),
            'amount' => $projects->total()
        ]);
    }
}