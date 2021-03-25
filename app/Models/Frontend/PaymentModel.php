<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Model;

class PaymentModel extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'payment_method'
    ];
}
