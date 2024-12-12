<?php

namespace Modules\Cars\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoutePriceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'required|numeric',
            'return_price' => 'numeric',
            'vehicle_model_id' => 'exists:vehicle_models,id',
            'route_id' => 'exists:routes,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return auth()->user()->hasPermissionTo('add_role');
        return true;
    }
}