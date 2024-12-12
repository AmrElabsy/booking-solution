<?php

namespace Modules\Cars\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'about',
        'isactive',
    ];

    public function vehicle_model() {
        return $this->belongsTo(VehicleModel::class);
    }
    
    protected static function newFactory()
    {
        return \Modules\Cars\Database\factories\VehicleTypeFactory::new();
    }
}
