<?php

namespace Modules\Cars\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Request;
use Modules\Cars\Entities\VehicleType;
use Modules\Domain\Responders\ApiResponder;
use Modules\Cars\Http\Services\VehicleTypeService;
use Modules\Cars\Http\Requests\StoreVehicleTypeRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Cars\Http\Requests\UpdateVehicleTypeRequest;
use Modules\Cars\Http\Repositories\VehicleTypeRepository;

class VehicleTypeController extends Controller
{
    public function __construct(
        private ApiResponder $responder,
        private VehicleTypeRepository $repository,
        private VehicleTypeService $service,
    ) {
    }

    public function index()
    {
        $this->authorize('list_vehicle_type');

        $vehicles_types = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('vehicles_types'));
    }

    public function store(StoreVehicleTypeRequest $request)
    {
        try {
            $vehicle_types = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $vehicle_types = $this->repository->getById($vehicle_types->id);
        return $this->responder->sendCreated(compact('vehicle_types'));
    }

    public function show($vehicle_type)
    {
        $this->authorize('list_vehicle_type');

        try {
            $vehicle_type = $this->repository->getById($vehicle_type);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess(compact('vehicle_type'));
    }

    public function update(UpdateVehicleTypeRequest $request, $vehicle_type)
    {
        try {
            $vehicle_type = $this->service->update($vehicle_type, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $vehicle_type = $this->repository->getById($vehicle_type->id);
        return $this->responder->sendSuccess(compact('vehicle_type'));
    }

    public function destroy($id)
    {
        $this->authorize('delete_vehicle_type');

        try {
            $this->repository->delete($id);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess();
    }

    public function bulk_delete(Request $request)
    {
        // $this->authorize('delete_vehicle_type');

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

            $results = VehicleType::query()
                ->where('name', 'LIKE',  $name . '%')
                ->where('isactive', 'LIKE',  $isactive . '%')

                ->get();
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendError($e->getMessage());
        }
        return $this->responder->sendSuccess(compact('results'));
    }
}
