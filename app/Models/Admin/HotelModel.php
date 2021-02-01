<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class HotelModel extends Model
{
    public $table = 'hotels';
    protected $fillable = [
        'province_id', 'category_id', 'hotel_name', 'hotel_phone', 'hotel_email', 'hotel_website', 'hotel_image', 'description', 'is_active'
    ];

    public function scopeSearchByKeyword($query, $keyword)
    {
        if ($keyword!='') {
            $query->where(function ($query) use ($keyword) {
                $query->where("hotel_name", "LIKE","%$keyword%")
                    ->orwhere("hotel_phone", "LIKE","%$keyword%")
                    ->orWhere("hotel_email", "LIKE", "%$keyword%")
                    ->orWhere("hotel_website", "LIKE", "%$keyword%");
            });
        }
        return $query;
    }

    public function rooms(){
        return $this->hasMany('App\Models\Admin\RoomModel', 'hotel_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Admin\CategoryModel', 'category_id');
    }
}
