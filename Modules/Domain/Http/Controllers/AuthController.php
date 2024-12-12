<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Password;
use Modules\Domain\Responders\ApiResponder;
use Modules\Domain\Http\Services\AuthService;
use Modules\Domain\Http\Requests\LoginRequest;
use Modules\Domain\Http\Requests\RegisterRequest;
use Modules\Domain\Http\Requests\StoreUserRequest;
use Modules\Domain\Http\Requests\ForgotPasswordRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AuthController extends Controller
{
    public function __construct(
        private ApiResponder $responder,
        private AuthService $service
    ) {
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        return $this->responder->sendCreated(compact('user'));
    }

    public function login(LoginRequest $request)
    {
//        dd('test');
        try {
            $data = $this->service->login($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }

        if ($data['message'] == 'login') {
            unset($data['message']);
            return $this->responder->sendSuccess(compact('data'));
        } else {
            return $this->responder->sendError('login invalid');
        }
    }

    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->responder->sendSuccess();
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
    }
}
