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
        if (!$request->pk || !$request->name) {
            return response('Произошла ошибка отправки данных', 400);
        }
        ReferenceProject::where('project_id', '=', $request->pk)
            ->where('name', '=', $request->name)
            ->update(['name' => $request->value]);
    }

    public function delete() {

    }

    public function create() {

    }
}
