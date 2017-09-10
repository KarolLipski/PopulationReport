<?php
include_once('Crawler/Crawler.php');
include_once('Report/Report.php');
include_once('Crawler/Extractors/WikiTableExtractor.php');
include_once('TableParsers/InternetUsersTableParser.php');
include_once('TableParsers/PopulationUsersTableParser.php');

$populationUrl = 'https://en.wikipedia.org/wiki/List_of_countries_and_dependencies_by_population';
$internetUsersUrl = 'https://en.wikipedia.org/wiki/List_of_countries_by_number_of_Internet_users';

$crawler = new Crawler();

$report = prepareReportFromLink($crawler, new InternetUsersTableParser(), $internetUsersUrl);

$report = prepareReportFromLink($crawler, new PopulationUsersTableParser(), $populationUrl, $report);

echo $report->renderReport();

exit();

/**
 * Downloads data from link and parse it.
 * Raport is dynamically creating during parsing data.
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
