<?php

namespace App\Views;

use App\Models\Entities\TurmaEntity;
use App\Models\Proxys\DashboardProxy;

class DashboardView extends View {
    public static function render($view, $items = [], $turmas = [], $params = [])
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
            'filters'=>ListView::render('components/label', [
                [
                    'label'=>'Turma',
                    'content'=>View::render("components/select",[
                        'name'=>'turma_id',
                        'options'=>ListView::render("components/option", array_merge(
                            [
                                [
                                    'value'=>'',
                                    'label'=>'Selecione um Turma',
                                    'attrs'=>'selected'
                                ],
                            ],
                            array_map(fn(TurmaEntity $item)=>[
                                'value'=>$item->getId(),
                                'label'=>$item->getNome(),
                                'attrs'=> (!empty($params['turma_id']) && $params['turma_id'] == $item->getId()) ? 'selected': ''
                            ], $turmas)
                        ))
                    ])
                ]
            ]).ListView::render('components/label', [
                [
                    'label'=>"Data Início",
                    'content'=>View::render('components/input', [                    
                        'name'=>'date_start',
                        'type'=>'date',
                        'value'=> $params['date_start']??'',
                    ])
                ],
                [
                    'label'=>"Data Termino",
                    'content'=>View::render('components/input', [                    
                        'name'=>'date_end',
                        'type'=>'date',
                        'value'=> $params['date_end']??'',
                    ])
                ]
            ])
        ], 'dashboard');
    }
}
