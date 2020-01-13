<?php
declare(strict_types=1);

namespace App\Utils;

use App\Exception\FileFormatException;
use App\Exception\SourceFileException;
use SplFileObject;

class CsvParser
{
    private const FILE_EXT = 'csv';

    private $pathToFile;
    private $file;
    private $result = [];
    private $headerData;

    public function __construct(string $file)
    {
        $this->pathToFile = $file;
    }

    /**
     * Parse csv file
     * @throws FileFormatException
     * @throws SourceFileException
     */
    private function parse(): void
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


        foreach ($this->getNextLine() as $index => $line) {

            if ($index === 0) {
                $this->headerData = $line;
            } else {
                if (!is_null($line)) {
                    $this->result[] = $line;
                }
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

        return $this->result;
    }

    public function getHeaderData(): array
    {
        if (empty($this->headerData)) {
            $this->parse();
        }

        return $this->headerData;
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
        while (!$this->file->eof()) {
            yield $this->file->fgetcsv();
        }

    }

}
