<?php

/**
 * Page object
 * Class Page
 */
class Page
{
    /**
     * Html content
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
    /**
     * Page constructor.
     */
    public function __construct()
    {
    }
}