<?php

interface Extractor
{
    public function extract($pageHtml);
    public function getResult();
}