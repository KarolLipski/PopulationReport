<?php
ini_set('display_errors',1);
include_once('Crawler/Crawler.php');
include_once('Report/Report.php');
include_once('Crawler/Extractors/WikiTableExtractor.php');
include_once('TableParsers/InternetUsersTableParser.php');
include_once('TableParsers/PopulationUsersTableParser.php');

$populationUrl = 'https://en.wikipedia.org/wiki/List_of_countries_and_dependencies_by_population';
$internetUsersUrl = 'https://en.wikipedia.org/wiki/List_of_countries_by_number_of_Internet_users';

$crawler = new Crawler();
$report = new Report();

$internetUsersTableParser = new InternetUsersTableParser();
$internetUsersTableParser->setReportBuffer($report);
$report = $crawler->getData($internetUsersUrl, new WikiTableExtractor($internetUsersTableParser));

$populationUsersTableParser = new PopulationUsersTableParser();
$populationUsersTableParser->setReportBuffer($report);
$report = $crawler->getData($populationUrl, new WikiTableExtractor($populationUsersTableParser));


echo $report->renderReport();

exit();

