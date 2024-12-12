<?php

namespace Modules\Cars\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\Domain\Transformers\CustomerResource;

class TripCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($trip) {
            return [
                'id' => $trip->id,
                'date_time' => $trip->date_time,
                'customer' => $trip->customer->user->first_name . ' '. $trip->customer->user->last_name,
                'pick_up_point' => $trip->route_price->route->pick_up_point,
                'drop_off_point' => $trip->route_price->route->drop_off_point,
                'vehicle_model' => $trip->route_price->vehicle_model->name
            ];
        });
    }
}
