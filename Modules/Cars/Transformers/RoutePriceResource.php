<?php

namespace Modules\Cars\Transformers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class RoutePriceResource extends JsonResource
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
            'price' => $this->price,
            'return_price' => $this->return_price,
            'vehicle_model_id' => $this->vehicle_model_id,
            'route_id' => $this->route_id,
        ];
    }
}