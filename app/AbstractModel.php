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

    public function scopeRelationDictionary($query) {
        /** @var \Illuminate\Database\Query\Builder $query */
        $table = $this->getTable();
        $query = $query->select([
                    "{$table}.name"
                ])->groupBy("{$table}.name")
                ->get();

        $query->map(function($item) {
            $item->projectIds = $this->where('name', '=', $item->name)->select('project_id')->pluck('project_id');
            return $item;
        });

        foreach ($query as $item) {
            $item->projects = Project::whereIn('id', $item->projectIds)->select(['id', 'company'])->get();
        }

        return $query;
    }
}