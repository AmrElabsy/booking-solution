<?php

namespace Modules\Cars\Http\Services;

use Modules\Cars\Entities\Route;
use Illuminate\Database\Eloquent\Model;
use Modules\Domain\Http\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RouteService extends BaseService
{

    public function store($data)
    {
        $model = new Route();

        $model->is_active = $data['is_active'];
        $model->pick_up_point = $data['pick_up_point'];
        $model->drop_off_point = $data['drop_off_point'];
        $model->pick_up_point_lat = $data['pick_up_point_lat'];
        $model->pick_up_point_lng = $data['pick_up_point_lng'];
        $model->drop_off_point_lat = $data['drop_off_point_lat'];
        $model->drop_off_point_lng = $data['drop_off_point_lng'];

        $model->save();

        return $model;
    }

    public function update($model, $data)
    {
        $model = Route::findorFail($model);

        $model->is_active = $data['is_active'];
        $model->pick_up_point = $data['pick_up_point'];
        $model->drop_off_point = $data['drop_off_point'];
        $model->pick_up_point_lat = $data['pick_up_point_lat'];
        $model->pick_up_point_lng = $data['pick_up_point_lng'];
        $model->drop_off_point_lat = $data['drop_off_point_lat'];
        $model->drop_off_point_lng = $data['drop_off_point_lng'];

        $model->save();
        return $model;
    }
}
