<?php

namespace App\Models\Database\Repositories;

use App\Models\Database\Database;
use App\Models\Entities\AlunoEntity;

/**
* @implements RepositoryInterface<AlunoEntity>
**/
class AlunoRepository implements RepositoryInterface{
    private Database $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }
    public function list(): array
    {
        $sql = $this->db->getScritpSql('alunos/select');
        return $this->db->select($sql,[]);
    }
    public function create($model): void
    {
        $sql = $this->db->getScritpSql('alunos/insert');
        $this->db->insert($sql, [
           ":nome" => $model->getNome(),
           ":email" => $model->getEmail(),
           ":turma_id" => $model->getTurmaId(),
        ]);
    }
    public function delete($id): void
    {
        $sql = $this->db->getScritpSql('alunos/delete');
        $this->db->delete($sql, [':id' => $id]);
    }
}
