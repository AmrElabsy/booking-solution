<?php

namespace Modules\Cars\Http\Services;

use Modules\Cars\Entities\Trip;
use Modules\Domain\Http\Services\BaseService;

class TripService extends BaseService
{
    
    public function store( $data )
    {
        $trip = new Trip();
        
        $trip->date_time = $data['date_time'];
        $trip->status = $data['status'];
        $trip->customer_id = $data['customer_id'];
        $trip->route_price_id = $data['route_price_id'];
        
        $trip->save();
        
        return $trip;
    }
    
    public function update( $id, $data )
    {
        $trip = Trip::findorFail($id);
    
        $trip->date_time = $data['date_time'];
        $trip->status = $data['status'];
        $trip->customer_id = $data['customer_id'];
        $trip->route_price_id = $data['route_price_id'];
    
        $trip->save();

        return $trip;
    }
}