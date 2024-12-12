<?php

namespace Modules\Cars\Http\Repositories;

use Modules\Cars\Entities\VehicleType;
use Modules\Cars\Transformers\VehicleTypeResource;
use Modules\Cars\Transformers\VehicleTypeCollection;
use Modules\Domain\Http\Repositories\BaseRepository;

class VehicleTypeRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(VehicleType::class, VehicleTypeCollection::class, VehicleTypeResource::class);
    }
}
