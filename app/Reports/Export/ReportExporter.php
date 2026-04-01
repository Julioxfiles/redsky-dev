<?php

namespace App\Reports\Export;

abstract class ReportExporter
{
    public function export(array $data)
    {
        $file = $this->createFile(); // Factory Method

        $formatted = $this->formatData($data);

        return $file->save($formatted);
    }

    abstract protected function createFile();

    protected function formatData(array $data)
    {
        return json_encode($data); // simplified
    }
}