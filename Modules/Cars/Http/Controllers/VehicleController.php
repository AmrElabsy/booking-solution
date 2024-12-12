<?php

namespace Modules\Cars\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Modules\Cars\Entities\Vehicle;
use App\Http\Controllers\Controller;
use Modules\Cars\Entities\VehicleType;
use Modules\Cars\Entities\VehicleModel;
use Modules\Domain\Responders\ApiResponder;
use Modules\Cars\Http\Services\VehicleService;
use Modules\Cars\Http\Requests\StoreVehicleRequest;
use Modules\Cars\Http\Requests\UpdateVehicleRequest;
use Modules\Cars\Http\Repositories\VehicleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Cars\Http\Repositories\VehicleTypeRepository;
use Modules\Cars\Http\Repositories\VehicleModelRepository;


class VehicleController extends Controller
{
    public function __construct(
        private ApiResponder $responder,
        private VehicleRepository $repository,
        private VehicleService $service,
        private VehicleModelRepository $repository_model,
    ) {
    }

    public function index()
    {
        $this->authorize('list_vehicle');
        $vehicles = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('vehicles'));
    }

    public function create()
    {
        $this->authorize('add_vehicle');

        $vehicle_models = $this->repository_model->getAll();

        return $this->responder->sendSuccess(compact('vehicle_models'));
    }

    public function store(StoreVehicleRequest $request)
    {
        try {
            $vehicle = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $vehicle = $this->repository->getById($vehicle->id);
        return $this->responder->sendCreated(compact('vehicle'));
    }

    public function show($vehicle)
    {
        $this->authorize('list_vehicle');

        try {
            $vehicle = $this->repository->getById($vehicle);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess(compact('vehicle'));
    }

    public function edit($vehicle)
    {
        $this->authorize('edit_vehicle');

        try {
            $vehicle = $this->repository->getById($vehicle);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        $vehicle_models = $this->repository_model->getAll();

        return $this->responder->sendSuccess(compact('vehicle', 'vehicle_models'));
    }

    public function update(UpdateVehicleRequest $request, $vehicle)
    {
        try {
            $vehicle = $this->service->update($vehicle, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $vehicle = $this->repository->getById($vehicle->id);
        return $this->responder->sendSuccess(compact('vehicle'));
    }

    public function destroy($id)
    {
        $this->authorize('delete_vehicle');

        try {
            $this->repository->delete($id);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess();
    }

    public function bulk_delete(Request $request)
    {
        $this->authorize('delete_vehicle');

        try {
            $this->repository->bulk_delete($request->get('ids', []));
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        return $this->responder->sendSuccess();
    }

    public function search(Request $request)
    {
        try {
            $color = $request->input('color');
            $isactive = $request->input('isactive');
            $license_plate = $request->input('license_plate');
            $model_name = $request->input('model_name');
            $type_name = $request->input('type_name');

            $model_id = VehicleModel::query()
                ->where('name', 'LIKE',  $model_name . '%')
                ->pluck('id');

            $type_id = VehicleType::query()
                ->where('name', 'LIKE',  $type_name . '%')
                ->pluck('id');


            $results = Vehicle::query()
                ->where('color', 'LIKE',  $color . '%')
                ->where('isactive', 'LIKE',  $isactive . '%')
                ->where('license_plate', 'LIKE',  $license_plate . '%')
                ->whereIn('model_id', $model_id)
                ->whereIn('type_id',  $type_id)
                ->get();
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendError($e->getMessage());
        }
        return $this->responder->sendSuccess(compact('results'));
    }
}
