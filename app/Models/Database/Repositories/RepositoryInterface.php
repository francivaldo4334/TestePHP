<?php

namespace App\Models\Database\Repositories;

/**
*@template T
**/
interface RepositoryInterface {
    function list(): array;
    function delete($id):void;
    /**
    * @param T $model
    **/
    function create(object $model):void;
}
