<?php
namespace App\Models\Entities;

class NotaEntity {
    private ?int $id;
    private int $aluno_id;
    private float $nota;
    private string $data_lancamento;
    private ?string $disciplina;


    public function getId(){
        return $this->id;
    }

    public function getAlunoId(){
        return $this->aluno_id;
    }
    public function getNota(){
        return $this->nota;
    }
    public function getDataLancamento(){
        return $this->data_lancamento;
    }
    public function getDisciplina(){
        return $this->disciplina;
    }

    public function setAlunoId($aluno_id){
        $this->aluno_id = $aluno_id;
    }
    public function setNota($nota){
        $this->nota = $nota;
    }
    public function setDataLancamento($data_lancamento){
        $this->data_lancamento = $data_lancamento;
    }
    public function setDisciplina($disciplina){
        $this->disciplina = $disciplina;
    }
    public function getNomeDoAluno(){
        return "Implement"; //TODO:
    }
}
