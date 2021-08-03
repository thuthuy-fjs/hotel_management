<?php

namespace App\Imports\Admin;

use App\Models\Frontend\GuestModel;
use Maatwebsite\Excel\Concerns\ToModel;

class GuestImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new GuestModel([
            'id' => $row['id'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'user_name' => $row['user_name'],
            'email' => $row['email'],
            'password' => $row['password'],
            'phone' => $row['phone'],
            'address' => $row['address'],
            'image' => $row['image'],
            'provider' => $row['provider'],
            'provider_id' => $row['provider_id'],
        ]);
    }
}
