<?php
declare(strict_types=1);

namespace App\Controllers\Utils;


class SqlConvert
{
    private $tableName;
    private $fileArray;
    private $columns;

    public function __construct(string $tableName, array $data, array $tableColumns)
    {
        $this->tableName = $tableName;
        $this->fileArray = $data;
        $this->columns = $tableColumns;
    }

    /**
     * Создает sql конструкцию
     * @return string
     */
    public function createStatement(): string
    {
        foreach ($this->fileArray as $valuesArray) {
            $result[] = implode(',', array_map(
                    function ($value) {
                        return "'{$value}'";
                    },
                    $valuesArray)
            );

            $values = array_map(function ($item) {
                return "({$item})";
            }, $result);
        }


        $columns = implode(',', array_map(
            function ($item) {
                return "`{$item}`";
            }, $this->columns));

        $valuesStatement = implode(',' . PHP_EOL, $values);


        return "INSERT INTO {$this->tableName} ({$columns})\nVALUES\n{$valuesStatement}" . PHP_EOL;
    }
}
