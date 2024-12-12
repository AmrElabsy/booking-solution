<?php

namespace Modules\Domain\Http\Repositories;

use Modules\Domain\Transformers\PermissionCollection;
use Modules\Domain\Transformers\PermissionResource;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    
    public function __construct()
    {
        parent::__construct(Permission::class, PermissionCollection::class, PermissionResource::class);
    }
}