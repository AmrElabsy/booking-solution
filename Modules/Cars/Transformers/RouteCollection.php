<?php

namespace Modules\Cars\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RouteCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($route) {
            return [
                'id' => $route->id,
                'pick_up_point' => $route->pick_up_point,
                'drop_off_point' => $route->drop_off_point,
                'is_active' => $route->is_active,
            ];
        })->all();
    }
}
