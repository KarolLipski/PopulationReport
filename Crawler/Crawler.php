<?php
include_once('Page.php');
include_once('Adapters/FileGetAdapter.php');

/**
 * Gets page content
 * Class Crawler
 */
class Crawler
{
    /**
     * Adapter using for downloading content
     * @var Adapter
     */
    protected $adapter;

    /**
     * PageCrawler constructor.
     */
    public function __construct()
    {
        $this->setAdapter(new FileGetAdapter());
    }

    /**
     * @return Adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param Adapter $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Gets page content and returns Page object
     * @param string $url
     * @return Page
     */
    public function getPage($url)
    {
        $page = new Page();
        $page->setContent($this->adapter->getPage($url));
        return $page;
    }

    /**
     * Gets specific data from page using extractor
     * @param string $url
     * @param Extractor $extractor
     * @return mixed
     */
    public function getData($url, Extractor $extractor)
    {
        $pageContent = $this->getPage($url);
        return $extractor->extract($pageContent);
    }


}