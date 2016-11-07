<?php

class View
{
    function generate($headerView, $contentView, $templateView, $data = null)
    {
        include 'application/views/' . $templateView;
    }
}