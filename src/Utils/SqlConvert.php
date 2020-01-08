<?php
declare(strict_types=1);

namespace App\Utils;


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
        $values = [];
        foreach ($this->fileArray as $valuesArray) {
            $values[] = "('" . implode("', '", $valuesArray) . "')";
        }

        $columns = "(`" . implode("`, `", $this->columns) . "`)";

        $valuesStatement = implode(',' . PHP_EOL, $values);

        return "INSERT INTO `$this->tableName` $columns\nVALUES\n $valuesStatement;" . PHP_EOL;
    }
}
