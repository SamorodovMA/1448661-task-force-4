<?php

namespace tf\models\exception;

class StatusException extends TaskException
{
    protected $message = 'Не корректно указан пользователь для данного статуса';
}
