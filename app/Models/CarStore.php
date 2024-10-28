<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarStore extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'is_open',
        'is_full',
        'city_id',
        'address',
        'phone_number',
        'cs_name',
    ];
}
