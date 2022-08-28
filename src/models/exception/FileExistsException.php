<?php

namespace tf\models\exception;

class FileExistsException extends TaskException
{
    protected $message = 'Файл не найден';
}
