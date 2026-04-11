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
    public function listWithFilters($filters): array {
        $sql = $this->db->getScritpSql('notas/select_where_');
        $params = [];
        if (!empty($filters['start_date'])) {
            $sql .= " AND data_lancamento >= :start_date";
            $params['start_date'] = $filters['start_date'];
        }
        if (!empty($filters['end_date'])) {
            $sql .= " AND data_lancamento <= :end_date";
            $params['end_date'] = $filters['end_date'];
        }

        if (!empty($filters['aluno_ids'])) {
            $sql .= " AND aluno_id in (".(implode(',', $filters['aluno_ids'])).")";
        }

        return $this->db->select($sql,$params, DashboardProxy::class);
    }
}
