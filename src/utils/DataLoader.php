<?php

declare(strict_types=1);

namespace htmlacademy\utils;

use htmlacademy\exeptions\SourceFileException;
use htmlacademy\exeptions\FileFormatException;

class DataLoader
{
    private $filename;
    private $columns;
    private $fp;

    private $result = [];
    private $error = null;

    /**
     * ContactsImporter constructor.
     * @param $filename
     * @param $columns
     */
    public function __construct(
        string $filename, array $columns
    )
    {
        $this->filename = $filename;
        $this->columns = $columns;
    }

    public function import():void
    {
        if (!$this->validateColumns($this->columns)) {
            throw new FileFormatException("Заданы неверные заголовки столбцов");
        }

        if (!file_exists($this->filename)) {
            throw new SourceFileException("Файл не существует");
        }

        $this->fp = fopen($this->filename, 'r');

        if (!$this->fp) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $header_data = $this->getHeaderData();

        if ($header_data !== $this->columns) {
            throw new FileFormatException("Исходный файл не содержит необходимых столбцов");
        }

        while ($line = $this->getNextLine()) {
            $this->result[] = $line;
        }
    }

    public function getData():array {
        return $this->result;
    }

    private function getHeaderData():?array {
        rewind($this->fp);
        $data = fgetcsv($this->fp);

        return $data;
    }

    private function getNextLine():?array {
        $result = null;

        if (!feof($this->fp)) {
            $result = fgetcsv($this->fp);
        }

        return $result;
    }

    private function validateColumns(array $columns):bool
    {
        $result = true;

        if (count($columns)) {
            foreach ($columns as $column) {
                if (!is_string($column)) {
                    $result = false;
                }
            }
        }
        else {
            $result = false;
        }

        return $result;
    }
}