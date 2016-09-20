<?php
/**
 * Project model
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use DB;

define("PATH_THUMBS_IMAGE", "/images/logos/thumbs/");

class Project extends Model {

    public $imgPath;
    const ORIGIN_DIR = '/images/logos/';

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

        if ($data->tags) {
            $tagsRequest = explode(',', $data->tags);
            $select->join('tag_projects', function ($join) use ($tagsRequest) {
                $join->on('projects.id', '=', 'tag_projects.project_id')
                    ->whereIn('tag_projects.name', $tagsRequest);
            });
        }

        $result = $select->select('projects.id')->get();

        $ids = [];
        foreach ($result as $item) {
            $ids[] = $item->id;
        }

        // нужно не для поиска, а именно для фильтрации, чтобы получать весь спектор тегов выборки
        if ($data->filterTags) {
            $tagsRequest = explode(',', $data->filterTags);
            $select->join('tag_projects', function ($join) use ($tagsRequest) {
                $join->on('projects.id', '=', 'tag_projects.project_id')
                    ->whereIn('tag_projects.name', $tagsRequest);
            });

            $result = $select->select('projects.id')->get();

            $filterIds = [];
            foreach ($result as $item) {
                $filterIds[] = $item->id;
            }

            $projects = $this->whereIn('id', $filterIds)->paginate($perPage);

            $tags = TagProject::whereIn('project_id', $ids)->groupBy('name')->get();
            foreach ($tags as $item) {
                if (in_array($item->name, $tagsRequest)) {
                    $item->active = true;
                }
            }
        } else {
            $projects = $this->whereIn('id', $ids)->paginate($perPage);
            $tags = TagProject::whereIn('project_id', $ids)->groupBy('name')->get();
        }

        return [
            'projects' => $projects,
            'tags'     => $tags
        ];
    }

    /**
     * Return logo url
     * @return string image url
     */
    public function getLogoAttribute() {
		if ($this->attributes['logo']) {
			$originImg = $this->attributes['logo'];
			$imgName = md5($this->attributes['logo']);

			$img = public_path() . '/images' . $originImg;
			if (file_exists(public_path() . PATH_THUMBS_IMAGE . $imgName)) {
				return PATH_THUMBS_IMAGE . $imgName;
			} else {
				if (file_exists($img)) {
					if (!file_exists(public_path() . PATH_THUMBS_IMAGE)) {
						mkdir(public_path() . PATH_THUMBS_IMAGE);
						chmod(public_path() . PATH_THUMBS_IMAGE, 0770);
					}
					$thumb = Image::make($img)->resize(100, null, function ($constraint) {
						$constraint->aspectRatio();
					});
					$thumb->save(substr(PATH_THUMBS_IMAGE, 1) . $imgName, 90);
					return PATH_THUMBS_IMAGE . $imgName;
				}
			}
		}
    }

	public function getImgPath($dir) {
        $this->imgPath = public_path() . $dir;
        return $this->imgPath;
	}

    public function references() {
        return $this->hasMany('App\ReferenceProject');
    }

    public function tags() {
        return $this->hasMany('App\TagProject');
    }
}
