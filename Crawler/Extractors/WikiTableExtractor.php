<?php
include_once(__DIR__.'/../Extractor.php');

/**
 * Gets table from wikipedia website
 * Class WikiTableExtractor
 */
class WikiTableExtractor implements Extractor
{
    /**
     * Xpath points to wikipedia table
     * @var string
     */
    protected $XPath = '//table[contains(@class,"wikitable")]/tr[position() > 1]';

    /**
     * data parser
     */
    protected $tableParser;

    public function __construct($parser)
    {
        $this->setTableParser($parser);
    }

    public function setTableParser($parser)
    {
        $this->tableParser = $parser;
    }

    public function getXPath()
    {
        return $this->XPath;
    }

    public function setXPath($XPath)
    {
        $this->XPath = $XPath;
    }

    /**
     * Extracts data from page and parses by specific parser
     * @param $page
     * @return mixed
     */
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

    /**
     * Returns extracted content
     * @return mixed
     */
    public function getResult()
    {
        return $this->tableParser->getResult();
    }
}