<?php

namespace App\Reports\Export\Exporters;

use App\Reports\Export\ReportExporter;
use App\Reports\Export\Files\PdfFile;

class PdfExporter extends ReportExporter
{
    protected function createFile()
    {
        return new PdfFile();
    }
}
