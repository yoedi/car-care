<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreService extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'store_services';

    protected $fillable = [
        'car_service_id',
        'car_store_id',
    ];
}
