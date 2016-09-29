<?php
/**
 * Controller for work with dictionarys
 *
 * @author Stanislav Golenzovskiy <golenzovskiy@gmail.com>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App\Http\Controllers;

use App\Project;
use App\ServiceProject;
use App\SectorProject;
use App\CountryProject;
use App\DictionaryProject;
use App\TagProject;
use DebugBar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DictionaryController extends Controller
{

    public function edit(Request $request)
    {
        return view('dictionary.edit', [
            'services' => ServiceProject::relationDictionary(),
            'sectors' => SectorProject::relationDictionary(),
            'allTags' => TagProject::relationDictionary(),
        ]);
    }

    public function remove(Request $request)
    {
        $dictionaries = [
            'services' => '\App\ServiceProject',
            'sectors' => '\App\SectorProject',
            'country' => '\App\CountryProject'
        ];
        if ($request->name) {
            $model = $dictionaries[$request->model];
            $model::where('name', '=', $request->name)->update(['name' => 'Прочее']);
        } else {
            return response('Произошла ошибка при попытке удаления', 400);
        }
    }
	
	public function update(Request $request)
    {
        $dictionaries = [
            'services' => '\App\ServiceProject',
            'sectors' => '\App\SectorProject',
            'country' => '\App\CountryProject'
        ];
        if ($request->name) {
            $model = $dictionaries[$request->model];
            $model::where('name', '=', $request->name)->update(['name' => $request->value]);
        } elseif ($request->name == '') {
            $model = new $dictionaries[$request->model];
            $model->name = $request->value;
            $model->save();
        } else {
            return response('Произошла ошибка при попытке обновления данных', 400);
        }
    }

}
