<?php

namespace Modules\Domain\Http\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Role;

class RoleService extends BaseService
{

    public function store($data)
    {
        $role = new Role();

        $role->name = $data['name'];
        $role->guard_name = 'api';
        $role->save();

        $role->syncPermissions($data['permissions'] ?? []);

        return $role;
    }

    public function update($id, $data)
    {
        $model = Role::findorFail($id);

        $model->name = $data['name'];

        $model->save();

        $model->syncPermissions($data['permissions'] ?? []);

        return $model;
    }
}
