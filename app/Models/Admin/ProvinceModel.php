<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ProvinceModel extends Model
{
    protected $table = 'provinces';

    public function hotels(){
        return $this->hasMany('App\Models\Admin\HotelModel', 'province_id');
    }
}
