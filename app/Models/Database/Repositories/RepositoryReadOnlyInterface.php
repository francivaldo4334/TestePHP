<?php

namespace App\Models\Database\Repositories;

/**
*@template T
**/
interface RepositoryReadOnlyInterface {    
    /**
    *@return array<T>
    **/
    function list(): array;
}
