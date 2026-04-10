<?php

namespace App\Views;

class AlunosView extends View {
    public static function render($view, $vars = []) {
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
                [
                    [
                       'name' => 'Francivaldo',
                       'email' => "francivaldodev@gmail.com",
                       'create_at' => '2025-01-02',
                       'class_name' => 'Ads' 
                    ],
                ],
                fn($item) => [
                    ['data' => $item['name']],
                    ['data' => $item['email']],
                    ['data' => $item['create_at']],
                    ['data' => $item['class_name']],
                ],
            ),
            'form_create_content'=> FormView::render(
                [
                   [
                       'placeholder' => 'Nome do aluno',
                       'value' => '',
                       'label' => 'Nome',
                       'name' => 'name',
                   ],
                   [
                       'placeholder' => 'E-mail do aluno',
                       'value' => '',
                       'label' => 'Email',
                       'type' => 'email',
                       'name' => 'email',
                   ],
                ],
                [
                   [
                      'label' => "Turma",
                      'options' => ListView::render('components/option', [
                              [
                                  'label' => "Item 1",
                                  'value' => 0,
                              ]
                      ])
                   ] 
                ],
                []
            ),
        ], 'alunos');
    }
}
