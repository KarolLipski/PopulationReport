<?php
include_once('ReportRow.php');
include_once('Renderers/BrowserRenderer.php');

class Report
{
    protected $totalIU = 0;
    protected $rows = array();
    protected $renderer;

    public function __construct()
    {
        $this->setRenderer(new BrowserRenderer());
    }

    /**
     * @return mixed
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * @param mixed $renderer
     * @return $this
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalIU()
    {
        return $this->totalIU;
    }

    /**
     * @param int $totalIU
     */
    public function setTotalIU($totalIU)
    {
        $this->totalIU = $totalIU;
    }

    public function addToTotal($count)
    {
        $this->totalIU = bcadd($this->totalIU, $count);
    }

    public function getRows()
    {
        return $this->rows;
    }

    public function getRow($index)
    {
        $index = ReportRow::trimCountryName($index);
        if (!isset($this->rows[$index])) {
            $this->rows[$index] = new ReportRow();
        }
        return $this->rows[$index];

    }

    public function addRow(ReportRow $row)
    {
        $this->rows[$row->getCountry()] = $row;
    }

    public function renderReport()
    {
        return $this->getRenderer()->render($this);
    }

}