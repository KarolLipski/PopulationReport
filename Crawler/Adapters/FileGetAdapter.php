<?php
include_once(__DIR__.'/../Adapter.php');

/**
 * Class FileGetAdapter
 */
class FileGetAdapter implements Adapter
{

    public function getPage($url)
    {
        return file_get_contents($url);
    }
}