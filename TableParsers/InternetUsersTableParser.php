<?php

include_once('BufferedTableParser.php');

class InternetUsersTableParser extends BufferedTableParser
{
    protected $fieldMapping = [
        0 => 'country',
        1 => 'internetUsers'
    ];

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