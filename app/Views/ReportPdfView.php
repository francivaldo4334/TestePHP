<?php

namespace App\Views;

class ReportPdfView extends ReportView{
    public static function render($view = 'report_templates/report_pdf', $notas = [], $alunos=[], $style="width:100%;")
    {
        return parent::render($view, $notas, $alunos, $style);
    }
}
