<?php

namespace Modules\Domain\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Domain\Responders\ApiResponder;
use Modules\Domain\Http\Services\UserService;
use Modules\Domain\Http\Requests\StoreUserRequest;
use Modules\Domain\Http\Requests\UpdateUserRequest;
use Modules\Domain\Http\Repositories\RoleRepository;
use Modules\Domain\Http\Repositories\UserRepository;
use Modules\Domain\Http\Requests\ChangePasswordRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class UserController extends Controller
{
    private $roleRepository;

    public function __construct(
        private ApiResponder $responder,
        private UserRepository $repository,
        private UserService $service
    ) {
        $this->roleRepository = new RoleRepository();
    }

    public function index()
    {
        $users = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('users'));
    }

    public function create()
    {
        $roles = $this->roleRepository->getAll();
        return $this->responder->sendSuccess(compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $user = $this->repository->getById($user->id);
        return $this->responder->sendCreated(compact('user'));
    }

    public function show($user)
    {
        try {
            $user = $this->repository->getById($user);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess(compact('user'));
    }

    public function edit($user)
    {
        try {
            $user = $this->repository->getById($user);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        $roles = $this->roleRepository->getAll();
        return $this->responder->sendSuccess(compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, $user)
    {
        try {
            $user = $this->service->update($user, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        $user = $this->repository->getById($user->id);
        return $this->responder->sendSuccess(compact('user'));
    }

    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        return $this->responder->sendSuccess();
    }

    public function bulk_delete(Request $request)
    {

        try {
            $this->repository->bulk_delete($request->get('ids', []));
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        return $this->responder->sendSuccess();
    }

    public function changepassword(ChangePasswordRequest $request, $user)
    {
        $this->authorize('edit_user');
        
        try {
            $user = $this->repository->getById($user);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }

        $msg = $this->service->changePassword($user, $request->all());
        
        if ($msg['message'] == 'success') {
            return $this->responder->sendSuccess();
        } else {
            return $this->responder->sendError(['error' => 'wrong password']);
        }
    }
}
