<?php
namespace tf\classes\tasks;

class Task
{
    const STATUS_NEW = 1; //'new'; //новое
    const STATUS_CANCELLED = 2; //'cancelled'; //отменено
    const STATUS_ACTIVE = 3; //'active'; // в работе - на исполнении
    const STATUS_DONE = 4; //'done'; //выполнено-завершено
    const STATUS_FAILED = 5; //'failed'; //провалено

    const RESPONSE_ACTION = 'response'; //Откликнуться на задание
    const CANCEL_ACTION = 'cancel';//Отменить
    const REFUSAL_ACTION = 'refusal'; //Отказаться от задания
    const COMPLETION_ACTION = 'completion'; //Завершить задание, выполнено
    const ACCEPT_ACTION = 'accept'; //Выполняется после нажатия заказчиком кнопки «Принять»? п.2.8 из ТЗ

    private int $customerId;
    private int $executorId;

    public function __construct( $customerId, $executorId)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
    }

    /**
     * Функция возвращает карту статусов
     * @return array
     */
    public static function getStatusesList(): array
    {
        return
            [
                self::STATUS_NEW => 'Новое',
                self::STATUS_CANCELLED => 'Отменено',
                self::STATUS_ACTIVE => 'В работе',
                self::STATUS_DONE => 'Выполнено',
                self::STATUS_FAILED => 'Провалено'
            ];
    }

    /**
     * Функция возвращает карту действий
     * @return array
     */
    public function getActionsList(): array
    {
        return
            [
                self::RESPONSE_ACTION => 'Откликнуться на задание',
                self::CANCEL_ACTION => 'Отменить',
                self::REFUSAL_ACTION => 'Отказаться от задания',
                self::COMPLETION_ACTION => 'Завершить задание, выполнено',
                self::ACCEPT_ACTION => 'Принять'
            ];
    }

    /**
     * Функция возвращает имя статуса, в который перейдёт задание после выполнения конкретного действия;
     * @param string $availableActions
     * @return string
     */
    public function getStatus(string $availableActions): string
    {
        switch ($availableActions) {
            case self::COMPLETION_ACTION: //2.5 Завершение задания, п. из ТЗ
                return self::STATUS_DONE;
                break;
            case self::REFUSAL_ACTION: //2.6 Отказ от задания, п. из ТЗ
                return self::STATUS_FAILED;
                break;
            case self::CANCEL_ACTION:  //2.7 Отмена задания, п. из ТЗ
                return self::STATUS_CANCELLED;
                break;
            case self::ACCEPT_ACTION: //2.8 Старт задания, п. из ТЗ
                return self::STATUS_ACTIVE;
                break;
            default:
                return self::STATUS_NEW;
        }
    }

    /**
     * Функция определяет список доступных действий в текущем статусе;
     * @param string $currentStatus
     * @return array
     */
    public function getAvailableActionsList(string $currentStatus): array
    {
        switch ($currentStatus) {
            case self::STATUS_NEW:
                return [self::RESPONSE_ACTION, self::CANCEL_ACTION];
                break;
            case self::STATUS_ACTIVE:
                return [self::COMPLETION_ACTION, self::REFUSAL_ACTION];
                break;
            default:
                return [];
        }
    }

    /**
     * Функция возвращает текущий статус задания;
     * @param string $currentStatus
     * @return string
     */
public function getCurrentStatus(string $currentStatus):string
{
    return $currentStatus;
}

//5.1 Хранить ID заказчика
    /**
     * Функция возвращает ID заказчика
     * @return int
     */
    public function getCustomerId(): int
    {
        return $this->customerId;
    }

//5.2 Хранить ID исполнителя
    /**
     * Функция возвращает ID исполнителя
     * @return int
     */
    public function getExecutorId(): int
    {
        return $this->executorId;
    }

}
