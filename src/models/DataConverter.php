<?php

namespace tf\models;

use SplFileObject;
use tf\models\exception\EmptyHeaderException;
use tf\models\exception\FileExistsException;

class DataConverter
{
    private string $csvFileName;
    private string $directory;
    private string $tableName;

    /**
     * @throws FileExistsException
     * @throws EmptyHeaderException
     */
    public function __construct(string $csvFileName, $directory, $tableName)
    {
        if (!file_exists($csvFileName)) {
            throw new FileExistsException();
        }
        if (!file_exists($directory)) {
            throw new FileExistsException();
        }
        if (empty($tableName)) {
            throw new EmptyHeaderException();
        }

        $this->csvFileName = $csvFileName;
        $this->directory = $directory;
        $this->tableName = $tableName;
    }


    public function createSqFile()
    {
        file_put_contents($this->directory, implode(PHP_EOL, $this->csvToSql()));
    }


    public function csvToSql(): array
    {
        $file = new SplFileObject($this->csvFileName);
        $file->setFlags(SplFileObject::READ_CSV);
        $headers = $file->current();

        $headers = implode(', ', preg_replace('~[^,]+(?=(,|$))~', "`$0`", $headers));
        $headers = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $headers);
        $headers = trim($headers, chr(0xC2) . chr(0xA0));

        foreach ($file as $row) {
            if (!in_array(null, $row)) {
                $values = implode(', ', preg_replace('~[^,]+(?=(,|$))~', "'$0'", $row));

                $sql[] = "INSERT INTO {$this->tableName} ({$headers}) VALUES ({$values});";
            }
        }
        array_shift($sql);
        return $sql;
    }
}
