<?php

namespace App\Reports\Export\Files;

class PdfFile
{
    public function save(string $data)
    {
        // Here you would generate a PDF using a library like Dompdf
        // For simplicity, we just simulate it
        $filename = 'report.pdf';
        file_put_contents($filename, "[PDF]\n" . $data);
        return $filename;
    }
}