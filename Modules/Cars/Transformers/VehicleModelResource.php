<?php

namespace Modules\Cars\Transformers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleModelResource extends JsonResource
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
            'name' => $this->name,
            'isactive' => $this->isactive,
            'model_year' => $this->model_year,
            'about' => $this->about,
            'type' => $this->type,

        ];
    }
}
