<?php

namespace Modules\Cars\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Domain\Transformers\CustomerResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date_time' => $this->date_time,
            'customer' => new CustomerResource( $this->customer ),
            'pick_up_point' => $this->route_price->route->pick_up_point,
            'pick_up_point_lat' => $this->route_price->route->pick_up_point_lat,
            'pick_up_point_lng' => $this->route_price->route->pick_up_point_lng,
            'drop_off_point' => $this->route_price->route->drop_off_point,
            'drop_off_point_lat' => $this->route_price->route->drop_off_point_lat,
            'drop_off_point_lng' => $this->route_price->route->drop_off_point_lng,
            'vehicle_model' => new VehicleModelResource( $this->route_price->vehicle_model )
        ];
    }
}
