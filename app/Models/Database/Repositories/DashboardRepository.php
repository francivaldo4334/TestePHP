<?php

namespace App\Models\Database\Repositories;

use App\Models\Database\Database;
use App\Models\Proxys\DashboardProxy;
/**
* @implements RepositoryReadOnlyInterface<DashboardProxy>
**/
class DashboardRepository implements RepositoryReadOnlyInterface{
    private Database $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }
    public function list(): array
    {
        $sql = $this->db->getScritpSql('notas/select');
        return $this->db->select($sql,[], DashboardProxy::class);
    }
}
