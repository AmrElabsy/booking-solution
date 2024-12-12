<?php

namespace Modules\Domain\Http\Services;

use App\Models\User;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Modules\Domain\Responders\ApiResponder;
use Modules\Domain\Http\Services\BaseService;
use Modules\Domain\Http\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService extends BaseService
{
    private ApiResponder $responder;


    public function store($data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' =>  Hash::make($data['password']),
        ]);
    
        if (isset($data['image'])) {
            $user->update([
                'image' => uploadImage($data['image'], "users")
            ]);
        }

        $user->save();

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }


        return $user;
    }

    public function update($id, $data)
    {
        $user = User::findorFail($id);
        $user->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
        ]);

        if (isset($data['image'])) {
            $user->update([
                'image' => uploadImage($data['image'], "users")
            ]);
        }
        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }
        $user->save();

        return $user;
    }
    
    public function changePassword($user, $data) {
        $user = User::find($user->id);
        if (Hash::check($data['old_password'], $user->password)) {
            $user->password = Hash::make($data['password']);
            $user->save();
            return [
                'message' => 'success'
            ];
        }
        
        return [
            'message' => 'error'
        ];
    }

}
