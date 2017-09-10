<?php
include_once(__DIR__.'/../Report/ReportRow.php');

abstract class BufferedTableParser
{
    protected $rows;
    protected $reportBuffer;
    protected $fieldMapping = [];

    public function setReportBuffer($buffer)
    {
        $this->reportBuffer = $buffer;
    }

     abstract function parseRow($row);


    public function getResult()
    {
        return $this->reportBuffer;
    }
}