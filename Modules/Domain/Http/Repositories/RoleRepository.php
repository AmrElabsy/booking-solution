<?php

namespace Modules\Domain\Http\Repositories;

use Modules\Domain\Transformers\RoleCollection;
use Modules\Domain\Transformers\RoleResource;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository
{
    const ADMIN = 1;
    const DRIVER = 2;
    const CUSTOMER = 3;
    
    public function __construct()
    {
        parent::__construct(Role::class, RoleCollection::class, RoleResource::class );
    }
}