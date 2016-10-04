<?php
/**
 * Controller for work with project
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App\Http\Controllers;

use App\Project;
use App\ReferenceProject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ReferencesController extends Controller {

    public function update(Request $request) {
        if (!$request->value) {
            return response('Значение обязательно к заполнению', 400);
        }
        if (!$request->pk) {
            return response('Произошла ошибка отправки данных', 400);
        }

        $model = new ReferenceProject();

        if (!$request->name) {
            // create
            if ($model->where('name', $request->value)->where('project_id', $request->pk)->count()) {
                return response('Такая референция уже существует', 400);
            } else {
                $model->insert([
                    'name' => $request->value,
                    'project_id' => $request->pk
                ]);
            }
        } else {
            // update
            $model->where('project_id', '=', $request->pk)
                ->where('name', '=', $request->name)
                ->update(['name' => $request->value]);
        }
    }

    public function remove(Request $request) {
        if ($request->id || $request->name) {
            ReferenceProject::where('project_id', '=', $request->id)
                ->where('name', '=', $request->name)
                ->forceDelete();
        } else {
            return response('Произошла ошибка при попытке удалить референцию', 400);
        }
    }

}
