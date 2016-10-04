<?php
/**
 * Controller for work with tags
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App\Http\Controllers;

use App\TagProject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TagsController extends Controller {

    public function getAllTags() {
        $tags = TagProject::dictionary();
        $result = [];
        foreach ($tags as $item) {
            $result[] = $item->name;
        }
        return response()->json($result);
    }
    
    public function update(Request $request) {
        if (!$request->value) {
            return response('Значение обязательно к заполнению', 400);
        }
        if (!$request->pk) {
            return response('Произошла ошибка отправки данных', 400);
        }

        $model = new TagProject();

        if (!$request->name) {
            // create
            if ($model->where('name', $request->value)->first()) {
                return response('Такой тег уже существует', 400);
            } else {
                $model->insert([
                    'name' => $request->value,
                    'project_id' => 0
                ]);
            }
        } else {
            // update
            $model->where('name', '=', $request->name)
                ->update(['name' => $request->value]);
        }
    }
    
    public function remove(Request $request) {
        if ($request->id || $request->name) {
            TagProject::where('name', '=', $request->name)
                ->forceDelete();
        } else {
            return response('Произошла ошибка при попытке удалить тег', 400);
        }
    }

}
