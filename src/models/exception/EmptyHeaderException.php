<?php

namespace tf\models\exception;

class EmptyHeaderException extends TaskException
{
protected $message = 'Не заполнено название таблицы';
}
