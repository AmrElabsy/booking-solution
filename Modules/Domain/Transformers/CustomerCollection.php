<?php

namespace Modules\Domain\Transformers;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ( $customer ) {
            return [
                'id' => $customer->id,
                'first_name' => $customer->user->first_name,
                'last_name' => $customer->user->last_name,
                'email' => $customer->user->email,
//            'phone' => $customer->user->phone,
                'gender' => $customer->gender ? "Male" : 'Female'
            ];
        })->all();
    }
}
