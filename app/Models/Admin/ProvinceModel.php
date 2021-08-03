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

    public function hotels()
    {
        return $this->hasMany(HotelModel::class, 'province_id');
    }

    public function country()
    {
        return $this->belongsTo(CountryModel::class, 'country_id');
    }
}
