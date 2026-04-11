<?php

namespace App\Views;

use App\Models\Proxys\DashboardProxy;

class DashboardView extends View {
    public static function render($view, $items = [])
    {
        return SidebarLayoutView::render('layouts/dashboard', [
            'table'=>TableView::render(
                [
                    ['title' => 'Aluno'],
                    ['title' => 'Turma'],
                    ['title' => 'Disciplina'],
                    ['title' => 'Nota'],
                    ['title' => 'Dt/Lancamento'],
                    ['title' => 'Media'],
                    ['title' => 'Ações'],
                ],
                $items,
                fn(DashboardProxy $item) => [
                    ['data'=>$item->getNomeDoAluno()],
                    ['data'=>$item->getNomeDaTurma()],
                    ['data'=>$item->getDisciplina()],
                    ['data'=>$item->getNota()],
                    ['data'=>$item->getDataLancamento()],
                    ['data'=>$item->getMediaDoAluno()],
                    ['data'=>"ações"],
                ],
            ),
        ], 'dashboard');
    }
}
