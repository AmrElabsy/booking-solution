<?php

namespace Modules\Cars\Http\Services;

use Modules\Cars\Entities\VehicleType;
use Modules\Domain\Http\Services\BaseService;

class VehicleTypeService extends BaseService
{

    public function store($data)
    {
        $model = new VehicleType();

        if (isset($data['image'])) {
            $model->image = uploadImage($data['image'], "vehicle_types");
        }
        $model->about = $data['about'];
        $model->name = $data['name'];
        $model->no_of_seats = $data['no_of_seats'];
        $model->isactive = $data['isactive'];
        $model->save();

        return $model;
    }

    public function update($model, $data)
    {
        $model = VehicleType::findorFail($model);
        $model->about = $data['about'];
        $model->name = $data['name'];
        $model->no_of_seats = $data['no_of_seats'];
        $model->isactive = $data['isactive'];

        if (isset($data['image'])) {
            $model->image = uploadImage($data['image'], "vehicle_types");
        }
        $model->save();
        return $model;
    }
}