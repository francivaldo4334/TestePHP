<?php

namespace App\Models\Entities;

use App\Models\Database\Repositories\TurmaRepository;

class AlunoEntity {
    private ?int $id;
    private string $nome;
    private string $email;
    private int $turma_id;
    private ?string $criado_em;

    public function setId($id){
        $this->id = $id;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function setTurmaId($turma_id){
        $this->turma_id = $turma_id;
    }

    
    public function getId(){
        return $this->id;
    }
    public function getNome(){
        return $this->nome;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getTurmaId(){
        return $this->turma_id;
    }

    
    public function getCriadoEm() {
        return $this->criado_em;
    }
    public function getNomeDaTurma() {
        $repo = new TurmaRepository();
        $turma = $repo->getById($this->getTurmaId());
        if (!$turma) return "";
        return $turma->getNome();
    }
}
