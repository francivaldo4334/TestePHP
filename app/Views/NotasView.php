<?php

namespace App\Views;

class NotasView extends View
{
    public static function render($view, $notas = [], $alunos = [])
    {

        return SidebarLayoutView::render('layouts/crud', [
            'btn_create' => View::render('components/button', [
                'content' => 'Adcionar Nota',
                'class' => 'btn-primary',
                'onclick' => 'id_modal_create.showModal()'
            ]),
            'list_content' => TableView::render(
                [
                    ['title' => 'Aluno'],
                    ['title' => 'Nota'],
                    ['title' => 'Disciplina'],
                    ['title' => 'Dt/Lançamento'],
                ],
                $notas,
                fn($item) => [
                    ['data' => $item->getNomeDoAluno()],
                    ['data' => $item->getNota()],
                    ['data' => $item->getDisciplina()],
                    ['data' => $item->getDataLancamento()],
                ],
            ),
            'form_create_content' => FormView::render(
                [
                    [
                        'placeholder' => 'Nota',
                        'value' => '',
                        'label' => 'Nota',
                        'name' => 'nota',
                        'type' => 'number',
                        'attrs' => 'required step="0.01" min="0.00" max="99999.99"',
                    ],
                    [
                        'placeholder' => 'Dt/Lançamento',
                        'value' => '',
                        'label' => 'Lançamento',
                        'type' => 'date',
                        'name' => 'lancamento',
                        'attrs' => 'required',
                    ],
                    [
                        'placeholder' => 'Nome da Disciplina',
                        'value' => '',
                        'label' => 'Disciplina',
                        'name' => 'disciplina',
                        'attrs' => 'required',
                    ],
                ],
                [
                    [
                        'label' => "Aluno",
                        'name' => "aluno_id",
                        'options' => ListView::render('components/option', array_merge([
                            [
                                'label' => "Selecione um item",
                                'value' => '',
                                'attrs' => "selected"
                            ]
                        ], array_map(fn($it) => [
                            'label' => $it->getNome(),
                            'value' => $it->getId(),
                        ], $alunos))),
                        'attrs' => 'required',
                    ]
                ],
                [
                    [
                        'type' => 'reset',
                        'content' => "Cancelar",
                        'onclick' => 'id_modal_create.close()'
                    ],
                    [
                        'type' => 'submit',
                        'class' => 'btn-primary',
                        'content' => "Salvar",
                    ]
                ],
                "POST",
                "/notas"
            ),
        ], 'notas');
    }
}
