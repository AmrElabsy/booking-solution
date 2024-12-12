<?php

namespace Modules\Cars\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleModelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:vehicle_models,name,' . request()->vehicle_model,
            'isactive' => 'boolean',
            'about' => 'string',
            'model_year' => 'required|integer',
            'type_id' => 'required|exists:vehicle_types,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->hasPermissionTo('edit_vehicle_model');
    }
}
