<?php

namespace Modules\Cars\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;
use Modules\Cars\Entities\VehicleModel;
use Modules\Domain\Responders\ApiResponder;
use Modules\Cars\Http\Services\VehicleModelService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Cars\Http\Requests\StoreVehicleModelRequest;
use Modules\Cars\Http\Requests\UpdateVehicleModelRequest;
use Modules\Cars\Http\Repositories\VehicleModelRepository;
use Modules\Cars\Http\Repositories\VehicleTypeRepository;


class VehicleModelController extends Controller
{
    public function __construct(
        private ApiResponder $responder,
        private VehicleModelRepository $repository,
        private VehicleModelService $service,
        private VehicleTypeRepository $repository_type,

    ) {
    }

    public function index()
    {
        $this->authorize('list_vehicle_model');

        $vehicle_models = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('vehicle_models'));
    }
    public function create()
    {
        $vehicle_types = $this->repository_type->getAll();

        return $this->responder->sendSuccess(compact('vehicle_types'));
    }

    public function store(StoreVehicleModelRequest $request)
    {
        try {
            $vehicle_model = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $vehicle_model = $this->repository->getById($vehicle_model->id);
        return $this->responder->sendCreated(compact('vehicle_model'));
    }

    public function show($vehicle_model)
    {
        $this->authorize('list_vehicle_model');

        try {
            $vehicle_model = $this->repository->getById($vehicle_model);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess(compact('vehicle_model'));
    }

    public function update(UpdateVehicleModelRequest $request, $vehicle_model)
    {
        try {
            $vehicle_model = $this->service->update($vehicle_model, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $vehicle_model = $this->repository->getById($vehicle_model->id);
        return $this->responder->sendSuccess(compact('vehicle_model'));
    }

    public function destroy($id)
    {
        $this->authorize('delete_vehicle_model');

        try {
            $this->repository->delete($id);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess();
    }

    public function bulk_delete(Request $request)
    {
        $this->authorize('delete_vehicle_model');

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
            $name = $request->input('name');
            $isactive = $request->input('isactive');
            $model_year = $request->input('model_year');

            $results = VehicleModel::query()
                ->where('name', 'LIKE',  $name . '%')
                ->where('isactive', 'LIKE',  $isactive . '%')
                ->where('model_year', 'LIKE',  $model_year . '%')

                ->get();
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendError($e->getMessage());
        }
        return $this->responder->sendSuccess(compact('results'));
    }
}