<?php
include_once('BufferedTableParser.php');

class PopulationUsersTableParser extends BufferedTableParser
{
    protected $fieldMapping = [
      1 => 'country',
      2 => 'population',
      3 => 'date'
    ];

    public function parseRow($row)
    {
        $reportRow = $this->reportBuffer->getRow($row[1]);
        foreach ($this->fieldMapping as $key => $field) {
            $method = 'set'.ucfirst($field);
            $reportRow->$method($row[$key]);
        }

    }
}