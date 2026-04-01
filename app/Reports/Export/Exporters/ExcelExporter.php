<?php

namespace App\Reports\Export\Exporters;

use App\Reports\Export\ReportExporter;
use App\Reports\Export\Files\ExcelFile;

class ExcelExporter extends ReportExporter
{
    protected function createFile()
    {
        return new ExcelFile();
    }
}