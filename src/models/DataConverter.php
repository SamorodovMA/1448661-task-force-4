<?php

namespace tf\models;

use SplFileObject;
use tf\models\exception\FileExistsException;

class DataConverter
{
    private string $csvFileName;
    private string $dirForNewFile;
    private string $tableName;
    /**
     * @throws FileExistsException
     */
    public function __construct(string $csvFileName, $dirForNewFile, $tableName)
    {
        if (!file_exists($csvFileName)) {
            throw new FileExistsException();
        }

        $this->csvFileName = $csvFileName;
        $this->dirForNewFile = $dirForNewFile;
        $this->tableName = $tableName;
    }


    public function createSqFile()
    {
        file_put_contents($this->dirForNewFile, implode(PHP_EOL, $this->csvToSql()));
    }

    public function csvToSql(): array
    {
        $file = new SplFileObject($this->csvFileName);
        $file->setFlags(SplFileObject::READ_CSV);
        $headerList[] = $file->current();
        $sql = [];
        foreach ($file as $row) {
            foreach ($headerList as $header) {
                $sql[] = "INSERT INTO {$this->tableName}({$header[0]}, {$header[1]}, {$header[2]}) VALUES ({$row[0]},{$row[1]},{$row[2]});";
            }

        }
        array_shift($sql) ;
        return $sql;
    }

}

