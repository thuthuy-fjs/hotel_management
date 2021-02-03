<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\SearchResult;

class ProvinceModel extends Model
{
    protected $table = 'provinces';
    protected $fillable = [
        'country_id', 'province_name', 'province_image'
    ];

    public function hotels(){
        return $this->hasMany('App\Models\Admin\HotelModel', 'province_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('provinces.show', $this->id);

        return new SearchResult(
            $this,
            $this->province_name,
            $url
        );
    }
}
