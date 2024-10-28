<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StorePhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'photo',
        'car_store_id',
    ];
}
