<?php
include_once(__DIR__.'/../Adapter.php');

class CurlAdapter implements Adapter
{

    public function getPage($url)
    {
        //@ todo curl implementation to get website
        throw new BadMethodCallException('Method not implemented');
    }
}