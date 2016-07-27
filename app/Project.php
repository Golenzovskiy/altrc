<?php
/**
 * Project model
 *
 * @author Sintsov Roman <romiras_spb@mail.ru>
 * @copyright Copyright (c) 2016, Altrc
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    /**
     * Return result by filter params
     * @param array $data filter params
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getByFilter($data) {
        return $this->all();
    }

    /**
     * Return logo url
     * @return string image url
     */
    public function getLogoAttribute() {
        return '/images' . $this->attributes['logo'];
    }

    public function references() {
        return $this->hasMany('App\ReferenceProject');
    }
}
