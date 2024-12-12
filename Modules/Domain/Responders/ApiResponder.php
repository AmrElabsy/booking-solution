<?php

namespace Modules\Domain\Responders;

use Modules\Domain\Transformers\PermissionCollection;

class ApiResponder
{
    public function sendSuccess($data = [], int $status = 200)
    {
        return response()->json([
            'message' => 'success',
            'errors' => false,
            'data' => $data,
            // 'permissions' => $this->getPermissions()
        ], $status);
    }

    public function sendCreated($data)
    {
        return response()->json([
            'message' => 'created',
            'errors' => false,
            'data' => $data,
            // 'permissions' => $this->getPermissions()
        ], 201);
    }

    public function sendError($data)
    {
        return response()->json([
            'message' => 'error',
            'errors' => true,
            'data' => $data,
            // 'permissions' => $this->getPermissions()
        ], 400);
    }

    public function sendNotFound()
    {
        return response()->json([
            'message' => 'not found',
            'errors' => true,
            // 'permissions' => $this->getPermissions()
        ], 404);
    }

    private function getPermissions()
    {
        if (auth()->user()) {
            $permissions = new PermissionCollection(auth()->user()->getAllPermissions());
        }

        return $permissions ?? null;
    }
}