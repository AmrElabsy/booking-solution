<?php

namespace Modules\Cars\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Domain\Entities\Customer;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    public function route_price() {
        return $this->belongsTo(RoutePrice::class);
    }
    
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
