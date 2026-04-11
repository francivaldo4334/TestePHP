<?php

namespace App\Models\Proxys;

use App\Models\Database\Repositories\AlunoRepository;
use App\Models\Entities\AlunoEntity;
use App\Utils\CalcMedia;

class DashboardProxy {

    private ?int $id;
    private int $aluno_id;
    private float $nota;
    private string $data_lancamento;
    private ?string $disciplina;

    public function getNota(){
        return $this->nota;
    }
    public function getDataLancamento(){
        return $this->data_lancamento;
    }
    public function getDisciplina(){
        return $this->disciplina;
    }

    public function getNomeDaTurma(){
        $aluno = $this->getAluno();
        return $aluno->getNomeDaTurma();
    }
    private function getAluno(): AlunoEntity{
        $repo = new AlunoRepository();
        $aluno = $repo->getById($this->aluno_id);
        return $aluno;
    }
    public function getNomeDoAluno(){
        $aluno = $this->getAluno();
        if (!$aluno) return "";
        return $aluno->getNome();
    }
    public function getMediaDoAluno(){
        $calcmedia = new CalcMedia();
        return $calcmedia->getMediaDoAluno($this->aluno_id);
    }
}
