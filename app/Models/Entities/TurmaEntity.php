<?php
namespace App\Models\Entities;
class TurmaEntity {
    private ?int $id;
    private string $nome;
    private int $ano;

    public function getAno(){
        return $this->ano;
    }
    public function getNome(){
        return $this->nome;
    }

    public function getId(){
        return $this->id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setAno($ano) {
        $this->ano = $ano;
    }
}
