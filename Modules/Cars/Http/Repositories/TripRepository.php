<?php

namespace Modules\Cars\Http\Repositories;

use Modules\Cars\Entities\Trip;
use Modules\Cars\Transformers\TripCollection;
use Modules\Cars\Transformers\TripResource;
use Modules\Domain\Http\Repositories\BaseRepository;

class TripRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Trip::class, TripCollection::class, TripResource::class);
    }
}