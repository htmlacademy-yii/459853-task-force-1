<?php
declare(strict_types=1);

namespace App\Controllers\Utils;

use App\Controllers\Exception\FileFormatException;
use App\Controllers\Exception\SourceFileException;
use SplFileObject;

class CsvParser
{
    private $pathToFile;
    private $file;
    private $result = [];

    private const FILE_EXT = 'csv';

    public function __construct(string $file)
    {
        $this->pathToFile = $file;
    }

    /**
     * Parse csv file
     * @throws FileFormatException
     * @throws SourceFileException
     */
    public function parse(): void
    {

        if (!file_exists($this->pathToFile)) {
            throw new SourceFileException('Файла не существует');
        }

        $this->file = new SplFileObject($this->pathToFile, 'r');

        if (!$this->file->isReadable()) {
            throw new FileFormatException('Файл нельзя прочитать');
        }

        if (!$this->file->getExtension() === self::FILE_EXT) {
            throw new FileFormatException('Неверный формат файла');
        }

        $this->file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::READ_AHEAD);


        foreach ($this->getNextLine() as $line) {

            if (!is_null($line)) {
                $this->result[] = $line;
            }
        }

    }

    /**
     * data from csv
     * @return array
     * @throws FileFormatException
     * @throws SourceFileException
     */
    public function getData(): array
    {
        if (empty($this->result)) {
            $this->parse();
        }

        return array_slice($this->result, 1);
    }

    public function getHeaderData(): array
    {
        $this->file->rewind();
        return $this->file->current();
    }

    /**
     * Название таблицы
     * @return string
     */
    public function getTableName(): string
    {
        return basename($this->pathToFile, '.csv');
    }

    /**
     * Get each row form csv
     * @return Generator|null
     */
    private function getNextLine(): ?\Generator
    {
        $result = null;

        while (!$this->file->eof()) {
            yield $this->file->fgetcsv();
        }

        return $result;
    }

}
