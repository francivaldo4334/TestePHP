<?php

namespace App\Models\Database\Repositories;

/**
*@template T
**/
interface RepositoryDetailInterface {
    /**
    * @return T
    **/
    public function getById($id): ?object;
}
