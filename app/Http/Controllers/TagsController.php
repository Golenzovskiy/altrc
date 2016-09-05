<?php
/**
 * Controller for work with tags
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App\Http\Controllers;

use App\TagProject;
use App\ReferenceProject;
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

}
