<?php

namespace Modules\Cars\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use Modules\Cars\Entities\Route;
use App\Http\Controllers\Controller;
use Modules\Domain\Responders\ApiResponder;
use Modules\Cars\Http\Services\RouteService;
use Modules\Cars\Http\Requests\StoreRouteRequest;
use Modules\Cars\Http\Requests\UpdateRouteRequest;
use Modules\Cars\Http\Repositories\RouteRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RouteController extends Controller
{
    public function __construct(
        private ApiResponder $responder,
        private RouteRepository $repository,
        private RouteService $service,

    ) {
    }

    public function index()
    {
        // $this->authorize('list_route');
        $routes = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('routes'));
    }

    public function create()
    {
        // $this->authorize('add_route');
        return $this->responder->sendSuccess();
    }

    public function store(StoreRouteRequest $request)
    {
        try {
            $route = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $route = $this->repository->getById($route->id);
        return $this->responder->sendCreated(compact('route'));
    }

    public function show($route)
    {
        try {
            $route = $this->repository->getById($route);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        return $this->responder->sendSuccess(compact('route'));
    }

    public function edit($route)
    {
        // $this->authorize('edit_route');

        try {
            $route = $this->repository->getById($route);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        return $this->responder->sendSuccess(compact('route'));
    }

    public function update(UpdateRouteRequest $request, $route)
    {
        try {
            $route = $this->service->update($route, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        $route = $this->repository->getById($route->id);
        return $this->responder->sendSuccess(compact('route'));
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