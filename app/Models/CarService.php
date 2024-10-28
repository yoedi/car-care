<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarService extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'about',
        'photo',
        'duration_in_hour',
    ];
}
