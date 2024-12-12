<?php

namespace Modules\Cars\Http\Services;

use Modules\Cars\Entities\RoutePrice;
use Illuminate\Database\Eloquent\Model;
use Modules\Domain\Http\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoutePriceService extends BaseService
{

    public function store($data)
    {
        $model = new RoutePrice();

        $model->price = $data['price'];
        $model->return_price = $data['return_price'];
        $model->vehicle_model_id = $data['vehicle_model_id'];
        $model->route_id = $data['route_id'];

        $model->save();

        return $model;
    }

    public function update($model, $data)
    {
        $model = RoutePrice::findorFail($model);

        $model->price = $data['price'];
        $model->return_price = $data['return_price'];
        $model->vehicle_model_id = $data['vehicle_model_id'];
        $model->route_id = $data['route_id'];

        $model->save();
        return $model;
    }
}