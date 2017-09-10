<?php
include_once('Crawler/Crawler.php');
include_once('Report/Report.php');
include_once('Crawler/Extractors/WikiTableExtractor.php');
include_once('TableParsers/InternetUsersTableParser.php');
include_once('TableParsers/PopulationUsersTableParser.php');

$populationUrl = 'https://en.wikipedia.org/wiki/List_of_countries_and_dependencies_by_population';
$internetUsersUrl = 'https://en.wikipedia.org/wiki/List_of_countries_by_number_of_Internet_users';

$crawler = new Crawler();

$internetUsersTableParser = new InternetUsersTableParser();
$report = prepareReportFromLink($crawler, $internetUsersTableParser, $internetUsersUrl);

$populationUsersTableParser = new PopulationUsersTableParser();
$report = prepareReportFromLink($crawler, $populationUsersTableParser, $populationUrl, $report);

echo $report->renderReport();

exit();

/**
 * Pobiera dane z Linku , parsuje je.
 * Raport tworzony jest bezposrodnie podczas pobierania danych z wiki.
 * @param $crawler Crawler
 * @param $tableParser BufferedTableParser
 * @param $url string
 * @param $report Report
 * @return Report
 */
function prepareReportFromLink($crawler, $tableParser, $url, $report = null)
{
    if($report === null ) {
        $report = new Report();
    }
    $tableParser->setReportBuffer($report);
    $report = $crawler->getData($url, new WikiTableExtractor($tableParser));
    return $report;
}