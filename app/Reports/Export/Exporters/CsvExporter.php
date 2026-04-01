<?php

namespace App\Reports\Export\Exporters;

use App\Reports\Export\ReportExporter;
use App\Reports\Export\Files\CsvFile;

class CsvExporter extends ReportExporter
{
    protected function createFile()
    {
        return new CsvFile();
       
    }
}
