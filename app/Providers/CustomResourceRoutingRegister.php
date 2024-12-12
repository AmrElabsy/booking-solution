<?php

namespace App\Providers;

class CustomResourceRoutingRegister extends \Illuminate\Routing\ResourceRegistrar
{
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy', 'bulk_delete', 'search'];

    protected function addResourceBulk_delete($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/bulk_delete';

        $action = $this->getResourceAction($name, $controller, 'bulk_delete', $options);

        return $this->router->post($uri, $action);
    }

    protected function addResourceSearch($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name) . '/search';

        $action = $this->getResourceAction($name, $controller, 'search', $options);

        return $this->router->post($uri, $action);
    }
}
