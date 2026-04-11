<?php

namespace App\Models\Database\Repositories;

use App\Models\Database\Database;
use App\Models\Entities\NotaEntity;

/**
* @implements RepositoryInterface<NotaEntity>
**/
class NotaRepository implements RepositoryInterface {
    private Database $db;
    public function __construct()
    {
        $this->db = Database::getConnection();
    }
    public function list(): array
    {
        $sql = $this->db->getScritpSql('notas/select');
        return $this->db->select($sql,[], NotaEntity::class);
    }
    public function create($model): void
    {
        $sql = $this->db->getScritpSql('notas/insert');
        $this->db->insert($sql, [
           ":aluno_id" => $model->getAlunoId(),
           ":nota" => $model->getNota(),
           ":disciplina" => $model->getDisciplina(),
           ":data_lancamento" => $model->getDataLancamento(),
        ]);
    }
    public function delete($id): void
    {
        $sql = $this->db->getScritpSql('notas/delete');
        $this->db->delete($sql, [':id' => $id]);
    }    
}
