<?php

namespace App\Views;

class SidebarLayoutView extends BaseView {
    public static function render($view, $vars = [], $selectedItem = '')
    {
        $contentRender = parent::render($view, $vars);
        return View::render('layouts/sidebar', [
            'side'=>ListView::render('components/menu-item', [
                    [
                        'label' => "Dashboard",
                        'href' => '/',
                        'attrs' => $selectedItem == 'dashboard' ? 'menu-active' : '',
                    ],
                    [
                        'label' => "Alunos",
                        'href' => '/alunos',
                        'attrs' => $selectedItem == 'alunos' ? 'menu-active' : '',
                    ],
                    [
                        'label' => "Turmas",
                        'href' => '/turmas',
                        'attrs' => $selectedItem == 'turmas' ? 'menu-active' : '',
                    ],
                    [
                        'label' => "Notas",
                        'href' => '/notas',
                        'attrs' => $selectedItem == 'notas' ? 'menu-active' : '',
                    ],
                ]),
            'content'=>$contentRender,
        ]);
    }
}
