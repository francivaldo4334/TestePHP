<?php

namespace App\Views;

class ReportDocxView extends ReportView{
    public static function render($view = 'report_templates/report_docx', $notas = [], $alunos=[], $style="")
    {
        return parent::render($view, $notas, $alunos, $style);
    }
}
