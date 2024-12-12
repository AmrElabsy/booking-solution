<?php

namespace Modules\Cars\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Modules\Cars\Entities\RoutePrice;
use App\Http\Controllers\Controller;
use Modules\Domain\Responders\ApiResponder;
use Modules\Cars\Http\Services\RoutePriceService;
use Modules\Cars\Http\Requests\StoreRoutePriceRequest;
use Modules\Cars\Http\Requests\UpdateRoutePriceRequest;
use Modules\Cars\Http\Repositories\RoutePriceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RoutePriceController extends Controller
{
    public function __construct(
        private ApiResponder $responder,
        private RoutePriceRepository $repository,
        private RoutePriceService $service,

    ) {
    }

    public function index()
    {
        // $this->authorize('list_route');
        $route_prices = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('route_prices'));
    }

    public function create()
    {
        // $this->authorize('add_route');
        return $this->responder->sendSuccess();
    }

    public function store(StoreRoutePriceRequest $request)
    {
        try {
            $route_price = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $route_price = $this->repository->getById($route_price->id);
        return $this->responder->sendCreated(compact('route_price'));
    }

    public function show($route_price)
    {
        try {
            $route_price = $this->repository->getById($route_price);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        return $this->responder->sendSuccess(compact('route_price'));
    }

    public function edit($route_price)
    {
        // $this->authorize('edit_route');

        try {
            $route_price = $this->repository->getById($route_price);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        return $this->responder->sendSuccess(compact('route_price'));
    }

    public function update(UpdateRoutePriceRequest $request, $route_price)
    {
        try {
            $route_price = $this->service->update($route_price, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        $route_price = $this->repository->getById($route_price->id);
        return $this->responder->sendSuccess(compact('route_price'));
    }

    public function destroy($id)
    {
        // $this->authorize('delete_route');

        try {
            $this->repository->delete($id);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        return $this->responder->sendSuccess();
    }

    public function bulk_delete(Request $request)
    {
        // $this->authorize('delete_route');

        try {
            $this->repository->bulk_delete($request->get('ids', []));
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        return $this->responder->sendSuccess();
    }
}