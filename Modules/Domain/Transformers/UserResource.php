<?php

namespace Modules\Domain\Transformers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'image' => asset($this->image),
            'role' => isset($this->roles[0]) ? $this->roles[0]?->name : ""
        ];
    }
}
