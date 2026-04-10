<?php

namespace App\Models\Database\Repositories;

use App\Models\Database\Database;
use App\Models\Entities\TurmaEntity;

/**
* @implements RepositoryInterface<TurmaEntity>
**/
class TurmaRepository implements RepositoryInterface {
    private Database $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }
    public function list(): array
    {
        $sql = $this->db->getScritpSql('turmas/select');
        return $this->db->select($sql,[], TurmaEntity::class);
    }
    public function create($model): void
    {
        $sql = $this->db->getScritpSql('turmas/insert');
        $this->db->insert($sql, [
           ":nome" => $model->getNome(),
           ":ano" => $model->getAno(),
        ]);
    }
    public function delete($id): void
    {
        $sql = $this->db->getScritpSql('turmas/delete');
        $this->db->delete($sql, [':id' => $id]);
    }    
}
