<?php
/**
 * Project model
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Project extends Model {

    /**
     * Return result by filter params
     * @param array $data filter params
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByFilter($data) {
        $perPage = 20;
        //DB::connection()->enableQueryLog();
        $select = DB::table('projects');

        if ($data->project) {
            $select->where('company', 'like', '%' . $data->project . '%');
        }

        if ($data->references) {
            $select->join('reference_projects', function ($join) use ($data) {
                $join->on('projects.id', '=', 'reference_projects.project_id')
                    ->where('reference_projects.name', 'like', '%' . $data->references . '%');
            });
        }

        if ($data->from) {
            if ($data->from && $data->to) {
                $select->whereYear('projects.year', '>=', $data->from);
                $select->whereYear('projects.year', '<=', $data->to);
            } else {
                $select->whereYear('projects.year', '=', $data->from);
            }
        }

        if ($data->services) {
            $select->join('service_projects', function ($join) use ($data) {
                $join->on('projects.id', '=', 'service_projects.project_id')
                    ->whereIn('service_projects.name', $data->services);
            });
        }

        if ($data->sectors) {
            $select->join('sector_projects', function ($join) use ($data) {
                $join->on('projects.id', '=', 'sector_projects.project_id')
                    ->whereIn('sector_projects.name', $data->sectors);
            });
        }

        if ($data->country) {
            $select->join('country_projects', function ($join) use ($data) {
                $join->on('projects.id', '=', 'country_projects.project_id')
                    ->whereIn('country_projects.name', $data->country);
            });
        }

        $result = $select->select('projects.id')->get();

        $ids = [];
        foreach ($result as $item) {
            $ids[] = $item->id;
        }

        return $this->whereIn('id', $ids)->paginate($perPage);
    }

    /**
     * Return logo url
     * @return string image url
     */
    public function getLogoAttribute() {
        return ($this->attributes['logo']) ? '/images' . $this->attributes['logo'] : '';
    }

    public function references() {
        return $this->hasMany('App\ReferenceProject');
    }

    public function tags() {
        return $this->hasMany('App\TagProject');
    }
}
