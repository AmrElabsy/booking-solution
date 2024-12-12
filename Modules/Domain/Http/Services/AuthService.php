<?php

namespace Modules\Domain\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService extends BaseService
{
    public function store($data)
    {
        $customerService = new CustomerService();

        return $customerService->store($data);
    }

    public function update($model, $data)
    {
    }

    public function login($data)
    {
        $user = User::where('email', $data['email'])->first();
        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('myapptoken')->plainTextToken;
            return [
                'message' => 'login',
                'user' => $user,
                'token' => $token
            ];
        }

        return [
            'message' => 'invalid'
        ];
    }
}
