<?php

/**
 * Interface Renderer
 * For rendering raport (browser/api/console)
 */
interface Renderer
{
    public function render(Report $report);

}