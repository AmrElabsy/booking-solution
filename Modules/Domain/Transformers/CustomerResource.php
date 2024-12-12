<?php

namespace Modules\Domain\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'email' => $this->user->email,
//            'phone' => $this->user->phone,
            'gender' => $this->gender ? "Male" : 'Female',
            'image' => asset($this->user->image)
        ];
    }
}
