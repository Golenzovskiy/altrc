<?php
/**
 * Controller for work with project
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Project;
use App\Helpers\Helper;

class ProjectController extends Controller {

    /**
     * Create new project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create() {
        return view('project.create');
    }

    /**
     * Save project
     * @param  Request $request request
     * @return Response
     */
    public function save(Request $request) {
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
           'result' => view('filter.item', ['projects' => $projects])->render(),
           'amount' => ''
       ]);
    }
}
