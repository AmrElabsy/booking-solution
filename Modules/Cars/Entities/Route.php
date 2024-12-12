<?php

namespace Modules\Cars\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'pick_up_point',
        'drop_off_point',
        'pick_up_point_lat',
        'pick_up_point_lng',
        'drop_off_point_lat',
        'drop_off_point_lng',
        'is_active',
    ];

    // public function price()
    // {
    //     return $this->belongsTo(RoutePrice::class, 'price_id');
    // }
    protected static function newFactory()
    {
        return \Modules\Cars\Database\factories\VehicleFactory::new();
    }
}
