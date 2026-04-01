<?php

namespace App\Reports\Export\Files;

class CsvFile
{
    public function save(string $data)
    {
        // Very simple CSV simulation
        $filename = 'report.csv';
        file_put_contents($filename, "[CSV]\n" . $data);
        return $filename;
    }
}