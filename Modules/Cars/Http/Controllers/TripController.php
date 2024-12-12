<?php

namespace Modules\Cars\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Modules\Cars\Http\Repositories\RoutePriceRepository;
use Modules\Cars\Http\Repositories\TripRepository;
use Modules\Cars\Http\Requests\StoreTripRequest;
use Modules\Cars\Http\Requests\UpdateTripRequest;
use Modules\Cars\Http\Services\TripService;
use Modules\Domain\Http\Repositories\CustomerRepository;
use Modules\Domain\Responders\ApiResponder;

class TripController extends Controller
{
    private CustomerRepository $customerRepository;
    private RoutePriceRepository $routePriceRepository;
    
    public function __construct(
        private ApiResponder $responder,
        private TripRepository $repository,
        private TripService $service
    ) {
        $this->customerRepository = new CustomerRepository();
        $this->routePriceRepository = new RoutePriceRepository();
    }
    
    public function index()
    {
        $this->authorize('list_trip');
        
        $trips = $this->repository->getAll();
        return $this->responder->sendSuccess(compact('trips'));
    }
    
    public function create()
    {
        $this->authorize('add_trip');
        
        $customers = $this->customerRepository->getAll();
        $routePrices = $this->routePriceRepository->getAll();
        
        return $this->responder->sendSuccess(compact('customers', 'routePrices'));
    }
    
    public function store(StoreTripRequest $request)
    {
        try {
            $trip = $this->service->store($request->all());
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        
        $trip = $this->repository->getById($trip->id);
        return $this->responder->sendCreated(compact('trip'));
    }
    
    public function show($trip)
    {
        $this->authorize('list_trip');
        
        try {
            $trip = $this->repository->getById($trip);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        
        return $this->responder->sendSuccess(compact('trip'));
    }
    
    public function edit($trip)
    {
        $this->authorize('edit_trip');
        
        try {
            $trip = $this->repository->getById($trip);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        
        return $this->responder->sendSuccess(compact('trip'));
    }
    
    public function update(UpdateTripRequest $request, $trip)
    {
        try {
            $trip = $this->service->update($trip, $request->all());
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        } catch (\Exception $e) {
            return $this->responder->sendError($e->getMessage());
        }
        
        $trip = $this->repository->getById($trip->id);
        return $this->responder->sendSuccess(compact('trip'));
    }
    
    public function destroy($trip)
    {
        $this->authorize('delete_trip');
        
        try {
            $this->repository->delete($trip);
        } catch (ModelNotFoundException $e) {
            return $this->responder->sendNotFound();
        }
        
        return $this->responder->sendSuccess();
    }
}