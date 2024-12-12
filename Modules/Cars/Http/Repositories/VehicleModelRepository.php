<?php

namespace Modules\Cars\Http\Repositories;


use Modules\Cars\Entities\VehicleModel;
use Modules\Cars\Transformers\VehicleModelResource;
use Modules\Cars\Transformers\VehicleModelCollection;
use Modules\Domain\Http\Repositories\BaseRepository;

class VehicleModelRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(VehicleModel::class, VehicleModelCollection::class, VehicleModelResource::class);
    }
}
