<?php

namespace Modules\Cars\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($vehicle) {
            return [
                'id' => $vehicle->id,
                'name' => $vehicle->name,
                'image' => asset($vehicle->image),
                'color' => $vehicle->color,
                'license_date' => $vehicle->license_date,
                'license_expire_date' => $vehicle->license_expire_date,
            ];
        })->all();
    }
}
