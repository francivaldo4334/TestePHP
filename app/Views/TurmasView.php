<?php

namespace App\Views;

use App\Models\Entities\TurmaEntity;

class TurmasView extends View {
    /**
    * @param array<TurmaEntity> $items
    **/
    public static function render($view, $items = [])
    {
        return SidebarLayoutView::render('layouts/crud', [
            'btn_create'=> View::render('components/button', [
                'content'=>'Adcionar Turma',
                'class'=> 'btn-primary',
                'onclick'=>'id_modal_create.showModal()'
            ]),
            'list_content' => TableWithDeleteActionView::render(
                [
                    ['title' => 'Nome'], 
                    ['title' => 'Ano'], 
                ],
                $items,
                fn($item) => [
                    ['data' => $item->getNome()],
                    ['data' => $item->getAno()],
                ],
            ),
            'form_create_content'=> FormView::render(
                [
                   [
                       'placeholder' => 'Nome da Turma',
                       'value' => '',
                       'label' => 'Nome',
                       'name' => 'name',
                       'attrs' => 'required',
                   ],
                   [
                       'placeholder' => 'Ano de inicio',
                       'value' => '',
                       'label' => 'Ano',
                       'type' => 'number',
                       'name' => 'ano',
                       'attrs' => 'required steps="1"',
                   ],
                ],
                [],
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
                "/turmas"
            ),
        ], 'turmas');
    }
}
