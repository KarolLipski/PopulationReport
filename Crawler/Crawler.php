<?php
include_once('Page.php');
include_once('Adapters/FileGetAdapter.php');

class Crawler
{

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
     * @param mixed $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    public function getPage($url)
    {
        $page = new Page();
        $page->setContent($this->adapter->getPage($url));
        return $page;
    }

    public function getData($url, Extractor $extractor)
    {
        $pageContent = $this->getPage($url);
        return $extractor->extract($pageContent);
    }


}