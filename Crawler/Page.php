<?php

class Page
{
    protected $content;

    /**
     * @return mixed
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