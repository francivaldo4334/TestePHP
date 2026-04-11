<?php
namespace App\Utils;

use App\Models\Database\Repositories\NotaRepository;

class CalcMedia {
    public function getMediaDoAluno($aluno_id){
        $repo = new NotaRepository();
        $notas = $repo->listByAlunoId($aluno_id);

        $soma = 0;
        $quantidade = count($notas);

        foreach($notas as $nota) {
            $soma += $nota->getNota() ?? 0;
        }

        $media = $soma / $quantidade;
        return $media;
    }
}
