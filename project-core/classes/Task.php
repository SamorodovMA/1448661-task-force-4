<?php

class Task
{
//1.1 Определять список из всех доступных статусов;
    const STATUS_NEW = 'new'; //новое
    const STATUS_CANCELLED = 'cancelled'; //отменено
    const STATUS_ACTIVE = 'active'; // в работе - на исполнении
    const STATUS_DONE = 'done'; //выполнено-завершено
    const STATUS_FAILED = 'failed'; //провалено

//1.2 Определять список из всех доступных действий;
    const RESPONSE_ACTION = 'response'; //Откликнуться на задание
    const CANCEL_ACTION = 'cancel';//Отменить
    const REFUSAL_ACTION = 'refusal'; //Отказаться от задания
    const COMPLETION_ACTION = 'completion'; //Завершить задание, выполнено
    const ACCEPT_ACTION = 'accept'; //Выполняется после нажатия заказчиком кнопки «Принять»? п.2.8 из ТЗ

    public string $currentStatus;


    public string $availableActions;

    public int $customerId;
    public int $executorId;


    public function __construct($currentStatus, $availableActions)
    {
        $this->currentStatus = $currentStatus;
        $this->availableActions = $availableActions;
    }


//2. Возвращать имя статуса, в который перейдёт задание после выполнения конкретного действия;
    public function getNameStatus(): ?string
    {
        return match ($this->availableActions) {
            self::COMPLETION_ACTION => self::STATUS_DONE, //2.5 Завершение задания/выполнено, п. из ТЗ
            self::REFUSAL_ACTION => self::STATUS_FAILED, //2.6 Отказ от задания, п. из ТЗ
            self::CANCEL_ACTION => self::STATUS_CANCELLED, //2.7 Отмена задания, п. из ТЗ
            self::ACCEPT_ACTION => self::STATUS_ACTIVE, //2.8 Старт задания, п. из ТЗ
            default => null
        };
    }

//3. Определять список доступных действий в текущем статусе;
    public function getAvailableActionsList(): array
    {
        return match ($this->currentStatus) {
            self::STATUS_NEW => [self::RESPONSE_ACTION, self::CANCEL_ACTION],

            self::STATUS_ACTIVE => [self::COMPLETION_ACTION, self::REFUSAL_ACTION],

            default => [],
        };
    }

//4.Хранить текущий статус задания;
    public function getAvailableActions(): string
    {
        return $this->availableActions;
    }

//5.1 Хранить и ID заказчика.
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

//5.2 Хранить ID исполнителя
    public function getExecutorId(): int
    {
        return $this->executorId;
    }

}
