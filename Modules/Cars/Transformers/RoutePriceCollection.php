<?php

namespace Modules\Cars\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoutePriceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($route_price) {
            return [
                'id' => $route_price->id,
                'price' => $route_price->price,
                'return_price' => $route_price->return_price,
                'vehicle_model_id' => $route_price->vehicle_model_id,
                'route_id' => $route_price->route_id,
            ];
        })->all();
    }
}