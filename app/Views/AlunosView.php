<?php

namespace App\Views;

use App\Models\Entities\AlunoEntity;

class AlunosView extends View {
    /**
    * @param array<AlunoEntity> $items
    **/
    public static function render($view, $items = [], $turmas = []) {

        return SidebarLayoutView::render('layouts/crud', [
            'btn_create'=> View::render('components/button', [
                'content'=>'Adcionar Aluno',
                'class'=> 'btn-primary',
                'onclick'=>'id_modal_create.showModal()'
            ]),
            'list_content' => TableView::render(
                [
                    ['title' => 'Nome'], 
                    ['title' => 'Email'], 
                    ['title' => 'Dt/Criação'], 
                    ['title' => 'Turma'], 
                ],
                $items,
                fn($item) => [
                    ['data' => $item->getNome()],
                    ['data' => $item->getEmail()],
                    ['data' => $item->getCriadoEm()],
                    ['data' => $item->getNomeDaTurma()],
                ],
            ),
            'form_create_content'=> FormView::render(
                [
                   [
                       'placeholder' => 'Nome do aluno',
                       'value' => '',
                       'label' => 'Nome',
                       'name' => 'name',
                       'attrs' => 'required',
                   ],
                   [
                       'placeholder' => 'E-mail do aluno',
                       'value' => '',
                       'label' => 'Email',
                       'type' => 'email',
                       'name' => 'email',
                       'attrs' => 'required',
                   ],
                ],
                [
                   [
                      'label' => "Turma",
                      'name' => "turma_id",
                      'options' => ListView::render('components/option', array_merge([
                              [
                                  'label' => "Selecione um item",
                                  'value' => '',
                                  'attrs' => "selected"
                              ]
                      ], array_map(fn($it)=>[
                          'label' => $it->getNome(),
                          'value' => $it->getId(),
                      ], $turmas))),
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
                "/alunos"
            ),
        ], 'alunos');
    }
}
