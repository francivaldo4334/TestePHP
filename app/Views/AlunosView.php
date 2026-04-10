<?php

namespace App\Views;

class AlunosView extends View {
    public static function render($view, $vars = []) {
        return SidebarLayoutView::render('layouts/crud', [
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
            )
        ], 'alunos');
    }
}
