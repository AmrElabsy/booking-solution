<?php

namespace Modules\Cars\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleModelRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:vehicle_models,name',
            'isactive' => 'boolean',
            'about' => 'string',
            'model_year' => 'required|integer',
            'type_id' => 'exists:vehicle_types,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        return auth()->user()->hasPermissionTo('add_vehicle_model');
    }
}
