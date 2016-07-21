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
    //

    public function getByFilter($data) {
        return $this->all();
    }
}
