<?php

namespace Modules\Cars\Http\Repositories;

use Modules\Cars\Entities\Vehicle;
use Modules\Domain\Http\Repositories\BaseRepository;
use Modules\Cars\Transformers\VehicleResource;
use Modules\Cars\Transformers\VehicleCollection;

class VehicleRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Vehicle::class, VehicleCollection::class, VehicleResource::class);
    }
}
