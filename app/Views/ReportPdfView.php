<?php

namespace App\Views;

use App\Models\Entities\AlunoEntity;
use App\Models\Proxys\DashboardProxy;

class ReportPdfView extends View {
    public static function render($notas = [], $alunos=[])
    {
        return parent::render('report_templates/report', [
            'nome_escola'=> "Nome da Escola",
            'table_notas'=> TableView::render(
                [
                    ['title'=>'Disciplina'],
                    ['title'=>'Aluno'],
                    ['title'=>'Data/Lançamento'],
                    ['title'=>'Nota'],
                ],
                $notas,
                fn(DashboardProxy $item)=>[
                    ['data'=>$item->getDisciplina()],
                    ['data'=>$item->getNomeDoAluno()],
                    ['data'=>$item->getDataLancamento()],
                    ['data'=>$item->getNota()],
                ]
            ),
            'table_media_aluno'=> TableView::render(
                [
                    ['title' => 'Aluno'],
                    ['title' => 'Media'],
                ],
                $alunos,
                fn(AlunoEntity $item)=>[
                    ['data' => $item->getNome()],
                    ['data' => $item->getMediaDoAluno()],
                ]
            ),
        ]);
    }
}
