<?php

namespace Modules\Domain\Http\Repositories;

use App\Models\User;
use Modules\Domain\Transformers\UserResource;
use Modules\Domain\Transformers\UserCollection;

class UserRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct(User::class, UserCollection::class, UserResource::class);
    }
}
