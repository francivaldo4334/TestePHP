<?php

namespace App\Utils;

use PhpOffice\PhpWord\Element\Section;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class DocxGenerator {
    private PhpWord $phpWord;
    private Section $section;

    public function __construct()
    {
        $this->phpWord = new PhpWord();
        $this->section = $this->phpWord->addSection();
    }

    public function generateByHtml(string $html): string 
    {
        try {
            if (ob_get_length()) ob_clean();
            ob_start();

            Html::addHtml($this->section, $html, true, false);
            $objWriter = IOFactory::createWriter($this->phpWord, 'Word2007');

            $objWriter->save('php://output');
            $docxContent = ob_get_clean();

            if (empty($docxContent)) {
                throw new \Exception("Falha ao gerar conteúdo do arquivo Word.");
            }

            return $docxContent;
        } catch (\Exception $e) {
            if (ob_get_length()) ob_end_clean();
            throw new \Exception("Erro na geração do DOCX: " . $e->getMessage(), 500);
        }
    }
}
