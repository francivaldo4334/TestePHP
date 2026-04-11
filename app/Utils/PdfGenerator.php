<?php

namespace App\Utils;

use Exception;
use Knp\Snappy\Pdf;

class PdfGenerator {
    private ?Pdf $snappy = null;
    public function __construct()
    {
        $this->snappy = new Pdf('/app/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64');
    }
    public function generateByHtml($html){
        try {
            if (!$this->snappy) throw new Exception("snappy não inicializado.", 500);
            $pdf = $this->snappy->getOutputFromHtml($html);
            if(ob_get_length())ob_clean();
            return $pdf;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}
