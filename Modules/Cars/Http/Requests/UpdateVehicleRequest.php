<?php

namespace Modules\Cars\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'file',
            'color' => 'string',
            'model_id' => 'exists:vehicle_models,id',
            'type_id' => 'exists:vehicle_types,id',
            'isactive' => 'boolean',
            'license_date' => 'date|date_format:Y-m-d',
            'license_expire_date' => 'date|date_format:Y-m-d',
            'car_license' => 'file',
            'license_plate' => 'string',

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
