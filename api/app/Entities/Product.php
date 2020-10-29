<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['created_at', 'updated_at'];

    const STATUS = [
        'approved' => 'approved',
        'unapproved' => 'unapproved',
    ];
}
