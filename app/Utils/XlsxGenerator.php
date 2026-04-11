<?php

namespace App\Utils;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class XlsxGenerator {
    private Spreadsheet $spreadsheet;
    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
    }
    public function generateXlsx(array $headers, array $rows) {
        try {
            if (ob_get_length()) ob_clean();
            ob_start();
            
            $sheet = $this->spreadsheet->getActiveSheet();

            $currentColumn = 'A';
            foreach ($headers as $header) {
                $sheet->setCellValue($currentColumn . '1', $header);
                $sheet->getStyle($currentColumn . '1')->getFont()->setBold(true);
                $sheet->getColumnDimension($currentColumn)->setAutoSize(true);                
                $currentColumn++;
            }

            $currentRow = 2;
            foreach ($rows as $rowData) {
                $currentColumn = 'A';
                foreach ($rowData as $value) {
                    $sheet->setCellValue($currentColumn . $currentRow, $value);
                    $currentColumn++;
                }
                $currentRow++;
            }

            $writer = new Xlsx($this->spreadsheet);
            $writer->save('php://output');
            
            return ob_get_clean();
            
        } catch (\Exception $e) {
            if (ob_get_length()) ob_end_clean();
            throw new \Exception("Erro ao processar dados no Excel: " . $e->getMessage());
        }
    }
}
