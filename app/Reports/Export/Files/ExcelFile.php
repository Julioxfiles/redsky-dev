<?php

namespace App\Reports\Export\Files;

class ExcelFile
{
    public function save(string $data)
    {
        // Here you would use PhpSpreadsheet or similar
        $filename = 'report.xlsx';
        file_put_contents($filename, "[EXCEL]\n" . $data);
        return $filename;
    }
}