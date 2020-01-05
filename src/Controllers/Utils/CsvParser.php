<?php


namespace App\Controllers\Utils;

use App\Controllers\Exception\SourceFileException;
use App\Controllers\Exception\FileFormatException;
use SplFileObject;

class CsvParser
{
    private $pathToFile;
    private $file;
    private $result = [];

    private const FILE_EXT = 'csv';

    public function __construct($file)
    {
        $this->pathToFile = $file;
    }

    public function parse()
    {

        if (!file_exists($this->pathToFile)) {
            throw new SourceFileException('Файла не существует');
        }

        $this->file = new SplFileObject($this->pathToFile, 'r');

        if (!$this->file->isReadable()) {
            throw new FileFormatException('Файл нельзя прочитать');
        }

        // TODO При текущей првоерке он всегда выбрасывает 1 ое исключение
        if (!$this-> ->getExtension() === self::FILE_EXT) {
            throw new FileFormatException('Неверный формат файла');
        }

        $this->file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::READ_AHEAD | SplFileObject::DROP_NEW_LINE);

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }

    }

    public function getData()
    {
        return $this->result;
    }

    private function getHeaderData()
    {
        $this->file->rewind();
        return $this->file->current();
    }

    private function getNextLine()
    {
        $result = null;

        while (!$this->file->eof()) {
            yield $this->file->fgetcsv();
        }

        return $result;
    }

}
