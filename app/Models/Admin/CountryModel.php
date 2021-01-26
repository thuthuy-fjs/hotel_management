<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CountryModel extends Model
{
    protected $table = 'countries';

    public function provinces(){
        return $this->hasMany('App\Models\Admin\ProvinceModel', 'country_id');
    }
}
