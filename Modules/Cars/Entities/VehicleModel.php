<?php

namespace Modules\Cars\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model_year',
        'about',
        'type_id',
        'isactive',
    ];

    public function type()
    {
        return $this->belongsTo(VehicleType::class);
    }

    protected static function newFactory()
    {
        return \Modules\Cars\Database\factories\VehicleModelFactory::new();
    }
}