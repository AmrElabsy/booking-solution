<?php

namespace Modules\Domain\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Modules\Domain\Entities\Customer;

class CustomerService extends BaseService
{

    public function store($data)
    {
        $userService = new UserService();
        $user = $userService->store($data);
        $user->syncRoles(['Customer']);

        $customer = new Customer();

        $customer->user_id = $user->id;
        $customer->gender = $data['gender'] ?? null;

        $customer->save();

        return $customer;
    }

    public function update($id, $data)
    {
        $customer = Customer::findorFail($id);

        $userService = new UserService();
        $userService->update($customer->user_id, $data);

        $customer->gender = $data['gender'];

        $customer->save();

        return $customer;
    }
}
