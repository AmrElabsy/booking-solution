<?php

namespace Modules\Cars\Http\Repositories;

use Modules\Cars\Entities\RoutePrice;
use Modules\Domain\Http\Repositories\BaseRepository;
use Modules\Cars\Transformers\RoutePriceResource;
use Modules\Cars\Transformers\RoutePriceCollection;

class RoutePriceRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(RoutePrice::class, RoutePriceCollection::class, RoutePriceResource::class);
    }
}
