<?php

include_once('BufferedTableParser.php');

class InternetUsersTableParser extends BufferedTableParser
{
    /**
     * mapper column indexes to field names
     * @var array
     */
    protected $fieldMapping = [
        0 => 'country',
        1 => 'internetUsers'
    ];

    /**
     * Parse single table row
     * @param $row
     * @return void
     */
    public function parseRow($row)
    {
        $reportRow = $this->reportBuffer->getRow($row[0]);
        foreach ($this->fieldMapping as $key => $field) {
            $method = 'set'.ucfirst($field);
            $reportRow->$method($row[$key]);
        }
        $this->reportBuffer->addToTotal($reportRow->getInternetUsers());
    }


}