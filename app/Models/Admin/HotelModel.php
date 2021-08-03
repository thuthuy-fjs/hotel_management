<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\SearchResult;

class HotelModel extends Model
{
    public $table = 'hotels';

    protected $fillable = [
        'province_id',
        'category_id',
        'hotel_name',
        'hotel_phone',
        'hotel_email',
        'hotel_website',
        'hotel_image',
        'description',
        'is_active'
    ];

    public function rooms()
    {
        return $this->hasMany(RoomModel::class, 'hotel_id');
    }

    public function province()
    {
        return $this->belongsTo(ProvinceModel::class, 'province_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }

    public function scopeFilters($query, $province, $times, $person_number)
    {
        $query->where(function ($query) use ($province) {
            $query->where('province_id', $province);
        })->whereDoesntHave('rooms', function ($query) use ($times) {
            $query->where('id', function ($query) use ($times) {
                $query->from("booking")
                    ->whereBetween('check_in_date', $times)
                    ->orWhereBetween('check_out_date', $times)
                    ->orWhere(function ($query) use ($times) {
                        $query->where('check_in_date', '<', $times[0])
                            ->where('check_out_date', '>', $times[1]);
                    })
                    ->select("room_id");
            });
        })->whereHas('rooms', function ($query) use ($person_number) {
            $query->where('room_type_id', function ($query) use ($person_number) {
                $query->from("room_types")
                    ->where('person_number', '>=', $person_number)
                    ->select("id");
            });
        });
        return $query;
    }
}
