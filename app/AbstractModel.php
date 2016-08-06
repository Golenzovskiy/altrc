<?php
/**
 * Abstract Model
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, altrc
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractModel extends Model {

    /**
     * Scope a query to only include unique values
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDictionary($query){
        return $query->select('name')->groupBy('name')->get();
    }

    public function scopeDeleteByProject($query, $id) {
        return $query->where('project_id', '=', $id)->delete();
    }
}