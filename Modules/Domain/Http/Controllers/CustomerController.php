<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Controller;
use Modules\Domain\Http\Repositories\CustomerRepository;
use Modules\Domain\Http\Requests\StoreCustomerRequest;
use Modules\Domain\Http\Requests\UpdateCustomerRequest;
use Modules\Domain\Http\Services\CustomerService;
use Modules\Domain\Responders\ApiResponder;

class CustomerController extends Controller
{
    public function __construct(
        private ApiResponder $responder,
        private CustomerRepository $repository,
        private CustomerService $service
    ) {}
    
    public function index()
    {
        $this->authorize('list_customer');
        
        $customers = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('customers'));
    
    }

    public function create()
    {
        $this->authorize('add_customer');
    
        return $this->responder->sendSuccess();
    }

    public function store(StoreCustomerRequest $request)
    {
        try {
            $customer = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        
        $customer = $this->repository->getById($customer->id);
        return $this->responder->sendCreated(compact('customer'));
    }

    public function show($customer)
    {
        $this->authorize('list_customer');
    
        try {
            $customer = $this->repository->getById($customer);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
    
        return $this->responder->sendSuccess(compact('customer'));    }

    public function edit($customer)
    {
        $this->authorize('edit_customer');
    
        try {
            $customer = $this->repository->getById($customer);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
    
    
        return $this->responder->sendSuccess(compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, $customer)
    {
        try {
            $customer = $this->service->update($customer, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
    
        $customer = $this->repository->getById($customer->id);
        return $this->responder->sendSuccess(compact('customer'));
    
    }

    public function destroy($customer)
    {
        $this->authorize('delete_customer');
    
        try {
            $this->repository->delete($customer);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
    
        return $this->responder->sendSuccess();
    }
}
