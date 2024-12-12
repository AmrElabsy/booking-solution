<?php

namespace Modules\Cars\Transformers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class RouteResource extends JsonResource
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
            'pick_up_point' => $this->pick_up_point,
            'drop_off_point' => $this->drop_off_point,
            'pick_up_point_lat' => $this->pick_up_point_lat,
            'pick_up_point_lng' => $this->pick_up_point_lng,
            'drop_off_point_lat' => $this->drop_off_point_lat,
            'drop_off_point_lng' => $this->drop_off_point_lng,
            'is_active' => $this->is_active,
        ];
    }
}
