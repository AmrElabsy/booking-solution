<?php

namespace Modules\Cars\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRouteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'is_active' => 'boolean',
            'pick_up_point' => 'required|string',
            'drop_off_point' => 'required|string',
            'pick_up_point_lat' => 'numeric',
            'pick_up_point_lng' => 'numeric',
            'drop_off_point_lat' => 'numeric',
            'drop_off_point_lng' => 'numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermissionTo('add_role');
    }
}