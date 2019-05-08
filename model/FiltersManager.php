<?php

class FiltersManager
{

    function getFilters()
    {
        $file_path = $_SERVER['DOCUMENT_ROOT'].'/pictures/filters/';
        $filters_array = scandir($file_path);

        return $filters_array;
    }
}