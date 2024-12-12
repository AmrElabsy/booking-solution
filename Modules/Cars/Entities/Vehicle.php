<?php

namespace Modules\Cars\Entities;

use Modules\Cars\Entities\VehicleType;
use Illuminate\Database\Eloquent\Model;
use Modules\Cars\Entities\VehicleModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'color',
        'model_id',
        'isactive',
        'license_date',
        'license_expire_date',
        'car_license',
        'license_plate',
    ];

    public function model()
    {
        return $this->belongsTo(VehicleModel::class, 'model_id');
    }

    protected static function newFactory()
    {
        return \Modules\Cars\Database\factories\VehicleFactory::new();
    }
}
