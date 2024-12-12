<?php

namespace Modules\Cars\Http\Repositories;

use Modules\Cars\Entities\Route;
use Modules\Domain\Http\Repositories\BaseRepository;
use Modules\Cars\Transformers\RouteResource;
use Modules\Cars\Transformers\RouteCollection;

class RouteRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Route::class, RouteCollection::class, RouteResource::class);
    }
}
