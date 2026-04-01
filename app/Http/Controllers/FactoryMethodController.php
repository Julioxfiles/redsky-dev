<?php

namespace App\Http\Controllers;
use App\Http\Request;
use App\Reports\Export\Exporters\PdfExporter;
use App\Reports\Export\Exporters\ExcelExporter;
use App\Reports\Export\Exporters\CsvExporter;
use Exception;

// This class could be called ExporterController
class FactoryMethodController {
   
    public function index(Request $request) {
        title("Factory Method");
        $exportTo = $request->input('exportTo');
        
        if ($exportTo == "PDF") {
            $exporter = new PdfExporter();
        } elseif ($exportTo == "Excel") {
            $exporter = new ExcelExporter();
        } elseif ($exportTo == "CSV") {
            $exporter = new CsvExporter();
        } else {
            throw new Exception("Exporter not found");
        }    
        /* Patron Factory Method.
        Internamente export ejecuta:
        $file = $this->createFile(); // Factory Method
        */
        $result = $exporter->export($request->input('data'));
        echo $result;
    }    
}