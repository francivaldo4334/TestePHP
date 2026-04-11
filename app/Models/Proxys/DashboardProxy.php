<?php

namespace App\Models\Proxys;

use App\Models\Database\Repositories\AlunoRepository;
use App\Models\Database\Repositories\NotaRepository;
use App\Models\Entities\AlunoEntity;
use App\Models\Entities\NotaEntity;

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
        $repo = new NotaRepository();
        $notas = $repo->listByAlunoId($this->aluno_id);

        $soma = 0;
        $quantidade = count($notas);

        foreach($notas as $nota) {
            $soma += $nota->getNota() ?? 0;
        }

        $media = $soma / $quantidade;
        return $media;
    }
}
