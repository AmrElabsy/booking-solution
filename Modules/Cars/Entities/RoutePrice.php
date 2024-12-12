<?php

namespace Modules\Cars\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoutePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'return_price',
        'vehicle_model_id',
        'route_id',
    ];

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    
    public function vehicle_model() {
        return $this->belongsTo(VehicleModel::class);
    }
    protected static function newFactory()
    {
        return \Modules\Cars\Database\factories\VehicleFactory::new();
    }
}