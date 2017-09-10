<?php
include_once(__DIR__.'/../Extractor.php');

class WikiTableExtractor implements Extractor
{
    protected $XPath = '//table[contains(@class,"wikitable")]/tr[position() > 1]';
    protected $tableParser;

    public function __construct($parser)
    {
        $this->setTableParser($parser);
    }

    public function setTableParser($parser)
    {
        $this->tableParser = $parser;
    }
    /**
     * @return string
     */
    public function getXPath()
    {
        return $this->XPath;
    }

    /**
     * @param string $XPath
     */
    public function setXPath($XPath)
    {
        $this->XPath = $XPath;
    }

    public function extract($page)
    {
        $doc = new DOMDocument();
        $doc->loadHTML($page->getContent());

        $a = new DOMXPath($doc);
        $table = $a->query($this->getXPath());

        foreach ($table as $row) {
            $resultRow = array();
            $columns = $row->childNodes;
            foreach($columns as $column) {
                if($column->nodeType == 1) {
                    $resultRow[] = $column->nodeValue;
                }
            }
            $this->tableParser->parseRow($resultRow);
        }
        return $this->getResult();
    }

    public function getResult()
    {
        return $this->tableParser->getResult();
    }
}