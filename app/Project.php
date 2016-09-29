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

class Project extends Model {

    public $imgPath;
    const ORIGIN_DIR = '/images/logos/';
    const THUMB_DIR = '/images/logos/thumbs/';

    /**
     * Return result by filter params
     * @param array $data filter params
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByFilter($data, $perPage = 20) {
        //DB::connection()->enableQueryLog();
        $select = DB::table('projects')->select('projects.id');

        if ($data->amountDisplayProjects) {
            $perPage = $data->amountDisplayProjects;
        }

        if ($data->search) {
            $select->leftJoin('reference_projects', 'projects.id', '=', 'reference_projects.project_id')
                ->leftJoin('tag_projects', 'projects.id', '=', 'tag_projects.project_id')
                ->orWhere(function ($query) use ($data) {
                    $query->orWhere('reference_projects.name', 'like', '%' . $data->search . '%')
                          ->orWhere('tag_projects.name', $data->search)
                          ->orWhere('projects.company', 'like', '%' . $data->search . '%')
                          ->orWhere('projects.company_alternative', 'like', '%' . $data->search . '%');
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
            $select->leftJoin('service_projects', function ($join) use ($data) {
                $join->on('projects.id', '=', 'service_projects.project_id')
                    ->whereIn('service_projects.name', $data->services);
            });
        }

        if ($data->sectors) {
            $select->leftJoin('sector_projects', function ($join) use ($data) {
                $join->on('projects.id', '=', 'sector_projects.project_id')
                    ->whereIn('sector_projects.name', $data->sectors);
            });
        }

        if ($data->country) {
            $select->leftJoin('country_projects', function ($join) use ($data) {
                $join->on('projects.id', '=', 'country_projects.project_id')
                    ->whereIn('country_projects.name', $data->country);
            });
        }

        $result = $select->get();

        $ids = [];
        foreach ($result as $item) {
            $ids[] = $item->id;
        }

        // нужно не для поиска, а именно для фильтрации, чтобы получать весь спектор тегов выборки
        if ($data->filterTags) {
            $tagsRequest = explode(',', $data->filterTags);
            if ($data->search) {
                $select->whereIn('tag_projects.name', $tagsRequest);
            } else {
                $select->leftJoin('tag_projects', function ($join) {
                    $join->on('projects.id', '=', 'tag_projects.project_id');
                });
                $select->whereIn('tag_projects.name', $tagsRequest);
            }
            
            $result = $select->get();

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
			$imgPathDB = $this->attributes['logo'];
			$imgThumb = md5($imgPathDB) . '.' . pathinfo($imgPathDB)['extension'];

			$img = $this->getImgPath(self::ORIGIN_DIR) . pathinfo($this->attributes['logo'])['basename'];
			if (file_exists($this->getImgPath(self::THUMB_DIR) . $imgThumb)) {
			    return self::THUMB_DIR . $imgThumb;
			} else {
				if (file_exists($img)) {
					if (!file_exists($this->getImgPath(self::THUMB_DIR))) {
						mkdir($this->getImgPath(self::THUMB_DIR));
						chmod($this->getImgPath(self::THUMB_DIR), 0770);
					}
					$thumb = Image::make($img)->resize(100, null, function ($constraint) {
						$constraint->aspectRatio();
					});
					$thumb->save($this->getImgPath(self::THUMB_DIR) . $imgThumb, 90);
					return self::THUMB_DIR . $imgThumb;
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
