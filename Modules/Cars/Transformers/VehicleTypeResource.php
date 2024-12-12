<?php

namespace Modules\Cars\Transformers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleTypeResource extends JsonResource
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
            'about' => $this->about,
            'no_of_seats'=>$this->no_of_seats,
            'image' => asset($this->image),
        ];
    }
}