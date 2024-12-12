<?php

namespace Modules\Cars\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VehicleModelCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($vehicle_model) {
            return [
                'id' => $vehicle_model->id,
                'name' => $vehicle_model->name,
                'model_year' => $vehicle_model->model_year,
            ];
        })->all();
    }
}
