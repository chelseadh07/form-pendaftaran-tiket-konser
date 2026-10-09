<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConcertRegistration extends Model
{
    protected $fillable = [
        'reference',
        'name',
        'email',
        'phone',
        'ticket_type',
        'quantity',
        'unit_price',
        'total_price',
    ];
}
