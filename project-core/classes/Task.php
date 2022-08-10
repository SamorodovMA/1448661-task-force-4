<?php

class Task
{
    const STATUS_NEW = 'new'; //новое
    const STATUS_CANCELLED = 'cancelled'; //отменено
    const STATUS_ACTIVE = 'active'; // в работе
    const STATUS_DONE = 'done'; //выполнено
    const STATUS_FAILED = 'failed'; //провалено

    const RESPONSE_ACTION = 'response'; //Откликнуться на задание
    const CANCEL_ACTION = 'cancel';//Отменить
    const REFUSAL_ACTION = 'refusal'; //Отказаться от задания
    const COMPLETION_ACTION = 'completion'; //Завершить задание

    const CUSTOMER = 'customer';
    const EXECUTOR = 'executor';
}
