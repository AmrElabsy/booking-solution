<?php

namespace Modules\Domain\Http\Repositories;

abstract class BaseRepository
{
    protected $model;
    protected $collection;
    protected $resource;
    
    public function __construct( $model,  $collection,  $resource) {
        $this->model = $model;
        $this->collection = $collection;
        $this->resource = $resource;
    }
    
    public function getAll() {
        return new $this->collection( $this->model::all() );
    }
    
    public function getById( $id ) {
        return new $this->resource( $this->model::findorFail($id) );
    }
    
    public function delete( $id ) {
        $this->model::findorFail($id)->delete();
    }
    
    public function bulk_delete($ids) {
        $this->model::whereIn('id', $ids)->delete();
    }
}