<?php

namespace App\Views;

use App\Views\View;

class BaseView extends View {
    public static function render($view, $vars = [])
    {
        $contentRender = parent::render($view, $vars);
        return View::render('layouts/base', [
            'content'=>$contentRender,
            'title'=>'Gestão Escolar',
        ]);
    }
}
