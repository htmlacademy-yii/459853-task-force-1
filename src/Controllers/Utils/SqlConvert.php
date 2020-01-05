<?php


namespace App\Controllers\Utils;


class SqlConvert
{
    private $fileArray;

    public function __construct($data)
    {
        $this->fileArray = $data;
    }

    public function convert()
    {
        foreach ($this->fileArray as $item) {
            var_dump($item);
        }
    }

}
