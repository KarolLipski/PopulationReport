<?php
include_once(__DIR__.'/../Renderer.php');

class BrowserRenderer implements Renderer
{
    public function render(Report $report)
    {
        return $this->generateHeader().$this->generateContent($report).$this->generateFooter();
    }

    private function generateContent($report)
    {
        $nf = new NumberFormatter("en_EN", NumberFormatter::PERCENT);
        $content = '<tbody>';
        foreach ($report->getRows() as $row) {
            $content .= "<tr>
                <td>{$this->renderValue($row->getCountry())}</td>
                <td>{$this->renderValue($row->getPopulation())}</td>
                <td>{$this->renderValue($row->getDate())}</td>
                <td>{$this->renderValue($row->getInternetUsers())}</td>
                <td>{$this->renderPercentCountryIU($row->getPercentageCountryIU())}</td>
                <td>{$this->renderValue($row->getPercentageWorldIU($report->getTotalIU()))}</td>
            </tr>
            ";
        }
        $content .= '</tbody>';
        return $content;
    }

    private function generateHeader()
    {
        $css = "<style>table.greyGridTable {
          border: 2px solid #FFFFFF;
          width: 100%;
          text-align: center;
          border-collapse: collapse;
        }
        table.greyGridTable td, table.greyGridTable th {
          border: 1px solid #FFFFFF;
          padding: 3px 4px;
        }
        table.greyGridTable tbody td {
          font-size: 13px;
        }
        table.greyGridTable td:nth-child(even) {
          background: #EBEBEB;
        }
        table.greyGridTable thead {
          background: #FFFFFF;
          border-bottom: 4px solid #333333;
        }
        table.greyGridTable thead th {
          font-size: 15px;
          font-weight: bold;
          color: #333333;
          text-align: center;
          border-left: 2px solid #333333;
        }
        table.greyGridTable thead th:first-child {
          border-left: none;
        }
        
        table.greyGridTable tfoot {
          font-size: 14px;
          font-weight: bold;
          color: #333333;
          border-top: 4px solid #333333;
        }
        table.greyGridTable tfoot td {
          font-size: 14px;
        }</style>";

        return $css . '<table class="greyGridTable">
                    <thead>
                        <tr>
                        <th>Country or dependent Teritory</th>
                        <th>Population</th>
                        <th>Date</th>
                        <th>Internet Users</th>
                        <th>Percentage:internet users in a country / population in a country</th>
                        <th>Percentage:internet users in a country / internet users worldwide</tr>
                    </thead>
                ';
    }



    private function generateFooter()
    {
        return '</table>';
    }

    private function renderPercentCountryIU($value)
    {
        if($value === null) {
            return '-';
        }
        return round($value).'%';
    }

    private function renderValue($value)
    {
        if($value === null) {
            return '-';
        }
        return $value;
    }


}