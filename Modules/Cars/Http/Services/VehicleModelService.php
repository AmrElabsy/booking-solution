<?php

namespace Modules\Cars\Http\Services;

use Modules\Cars\Entities\VehicleModel;
use Illuminate\Database\Eloquent\Model;
use Modules\Domain\Http\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehicleModelService extends BaseService
{

    public function store($data)
    {
        $model = new VehicleModel();

        $model->name = $data['name'];
        $model->model_year = $data['model_year'];
        $model->about = $data['about'];
        $model->isactive = $data['isactive'];
        $model->type_id = $data['type_id'];


        $model->save();


        return $model;
    }

    public function update($model, $data)
    {
        $model = VehicleModel::findorFail($model);

        $model->name = $data['name'];
        $model->model_year = $data['model_year'];
        $model->about = $data['about'];
        $model->isactive = $data['isactive'];
        $model->type_id = $data['type_id'];

        $model->save();
        return $model;
    }
}
