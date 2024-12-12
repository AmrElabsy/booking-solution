<?php

namespace Modules\Cars\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($vehicle_type) {
            return [
                'id' => $vehicle_type->id,
                'name' => $vehicle_type->name,
                'image' => asset($vehicle_type->image),
            ];
        })->all();
    }
}
