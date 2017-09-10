<?php

/**
 * Interface Extractor
 * Using for extract specific content from page
 */
interface Extractor
{
    public function extract($pageHtml);
    public function getResult();
}