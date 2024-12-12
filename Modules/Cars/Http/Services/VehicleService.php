<?php

namespace Modules\Cars\Http\Services;

use Modules\Cars\Entities\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Modules\Domain\Http\Services\BaseService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehicleService extends BaseService
{

    public function store($data)
    {
        $model = new Vehicle();

        $model->color = $data['color'];
        $model->model_id = $data['model_id'];
        $model->isactive = $data['isactive'];

        $model->license_date = $data['license_date'];
        $model->license_expire_date = $data['license_expire_date'];
        $model->license_plate = $data['license_plate'];

        if (isset($data['image'])) {
            $model->image = uploadImage($data['image'], "vehicles");
        }
        
        if (isset($data['car_license'])) {
            $model->car_license =  uploadImage($data['car_license'], "vehicles");
        }

        $model->save();

        return $model;
    }

    public function update($model, $data)
    {
        $model = Vehicle::findorFail($model);

        $model->color = $data['color'];
        $model->model_id = $data['model_id'];
        $model->type_id = $data['type_id'];
        $model->isactive = $data['isactive'];

        $model->license_date = $data['license_date'];
        $model->license_expire_date = $data['license_expire_date'];
        $model->license_plate = $data['license_plate'];

        if (isset($data['image'])) {
            $model->update([
                'image' => uploadImage($data['image'], "vehicles")
            ]);
        }

        if (isset($data['car_license'])) {
            $model->update([
                'car_license' => uploadImage($data['car_license'], "vehicles")
            ]);
        }

        $model->save();
        return $model;
    }
}
