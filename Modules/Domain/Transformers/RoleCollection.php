<?php

namespace Modules\Domain\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray( $request )
    {
        return $this->collection->map(function ( $role ) {
            return [
                'id' => $role->id,
                'name' => $role->name
            ];
        })->all();
    }
}
