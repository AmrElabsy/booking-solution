<?php

namespace Modules\Domain\Http\Repositories;

use Modules\Domain\Entities\Customer;
use Modules\Domain\Transformers\CustomerCollection;
use Modules\Domain\Transformers\CustomerResource;

class CustomerRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(Customer::class, CustomerCollection::class, CustomerResource::class);
    }
}