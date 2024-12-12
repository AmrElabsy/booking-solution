<?php

namespace Modules\Cars\Transformers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
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
            'image' => asset($this->image),
            'color' => $this->color,
            'add_field' => $this->add_field,
            'isactive' => $this->isactive,
            'model' => $this->model,
            'type' => $this->type,
            'license_date' => $this->license_date,
            'license_expire_date' => $this->license_expire_date,
            'car_license' => asset($this->car_license),
            'license_plate' => $this->license_plate,

        ];
    }
}
