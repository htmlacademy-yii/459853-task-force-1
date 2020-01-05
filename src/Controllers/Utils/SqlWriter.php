<?php
declare(strict_types=1);

namespace App\controllers\Utils;

use App\Controllers\Exception\SourceFileException;
use SplFileInfo;
use SplFileObject;

class SqlWriter
{
    private $directoryPath;
    private $tableName;

    public function __construct(string $tableName, string $pathTo)
    {
        $this->directoryPath = $pathTo;
        $this->tableName = $tableName;
    }

    /**
     * Запись данных в файл
     * @param string $data
     * @throws SourceFileException
     */
    public function write(string $data): void
    {
        $directory = new SplFileInfo($this->directoryPath);

        if ($directory->isDir()) {
            $fileName = $this->tableName . '_' . time() . '.sql';
            $file = new SplFileObject($this->directoryPath . $fileName, 'a');
            $file->fwrite($data);
        } else {
            throw new SourceFileException('Данной директории не существует');
        }

    }

}
