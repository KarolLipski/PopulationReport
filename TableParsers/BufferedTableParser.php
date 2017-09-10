<?php
include_once(__DIR__.'/../Report/ReportRow.php');

/**
 * Parse table and buffer result in Report object
 * Class BufferedTableParser
 */
abstract class BufferedTableParser
{
    protected $rows;
    protected $reportBuffer;
    protected $fieldMapping = [];

    public function setReportBuffer($buffer)
    {
        $this->reportBuffer = $buffer;
    }

    /**
     * Parse single table row
     * @param $row
     * @return mixed
     */
     abstract function parseRow($row);


    public function getResult()
    {
        return $this->reportBuffer;
    }
}