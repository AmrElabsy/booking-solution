<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Modules\Domain\Http\Repositories\PermissionRepository;
use Modules\Domain\Http\Repositories\RoleRepository;
use Modules\Domain\Http\Requests\StoreRoleRequest;
use Modules\Domain\Http\Requests\UpdateRoleRequest;
use Modules\Domain\Http\Services\RoleService;
use Modules\Domain\Responders\ApiResponder;


class RoleController extends Controller
{
    private $permissionRepository;

    public function __construct(
        private ApiResponder $responder,
        private RoleRepository $repository,
        private RoleService $service
    ) {
        $this->permissionRepository = new PermissionRepository();
    }

    public function index()
    {
        $this->authorize('list_role');
    
        $roles = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('roles'));
    }

    public function create()
    {
        $this->authorize('add_role');
        
        $permissions = $this->permissionRepository->getAll();
        return $this->responder->sendSuccess(compact('permissions'));
    }

    public function store(StoreRoleRequest $request)
    {
        try {
            $role = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $role = $this->repository->getById($role->id);
        return $this->responder->sendCreated(compact('role'));
    }

    public function show($role)
    {
        $this->authorize('list_role');
        
        try {
            $role = $this->repository->getById($role);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess(compact('role'));
    }

    public function edit($role)
    {
        $this->authorize('edit_role');
        
        try {
            $role = $this->repository->getById($role);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        $permissions = $this->permissionRepository->getAll();

        return $this->responder->sendSuccess(compact('role', 'permissions'));
    }

    public function update(UpdateRoleRequest $request, $role)
    {
        try {
            $role = $this->service->update($role, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $role = $this->repository->getById($role->id);
        return $this->responder->sendSuccess(compact('role'));
    }

    public function destroy($role)
    {
        $this->authorize('delete_role');
        
        try {
            $this->repository->delete($role);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess();
    }
}
