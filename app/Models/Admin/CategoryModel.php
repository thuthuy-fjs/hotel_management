<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    public $table = 'categories';

    public function hotels(){
        return $this->hasMany(HotelModel::class, 'category_id');
    }

}
