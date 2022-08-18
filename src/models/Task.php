<?php
namespace tf\models;

class Task
{
    const STATUS_NEW = 1; //'new'; //новое
    const STATUS_CANCELLED = 2; //'cancelled'; //отменено
    const STATUS_ACTIVE = 3; //'active'; // в работе - на исполнении
    const STATUS_DONE = 4; //'done'; //выполнено-завершено
    const STATUS_FAILED = 5; //'failed'; //провалено

    const ACTION_START = 1; //'start'; //заказчик запускает задачу
    const ACTION_RESPONSE = 'response'; //Откликнуться на задание
    const ACTION_CANCEL = 'cancel';//Отменить
    const ACTION_REFUSAL = 'refusal'; //Отказаться от задания
    const ACTION_COMPLETION = 'completion'; //Завершить задание, выполнено
    const ACTION_ACCEPT = 'accept'; //Выполняется после нажатия заказчиком кнопки «Принять»? п.2.8 из ТЗ

    private int $customerId;
    private ?int $executorId;
    private int $status;

    public function __construct(int $status, int $customerId, ?int $executorId = null)
    {
        $this->customerId = $customerId;
        $this->executorId = $executorId;
        $this->status = $status;
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
                self::ACTION_RESPONSE => 'Откликнуться на задание',
                self::ACTION_CANCEL => 'Отменить',
                self::ACTION_REFUSAL => 'Отказаться от задания',
                self::ACTION_COMPLETION => 'Завершить задание, выполнено',
                self::ACTION_ACCEPT => 'Принять'
            ];
    }

    /**
     * * Функция возвращает имя статуса, в который перейдёт задание после выполнения конкретного действия;
     * @param string $availableActions
     * @return int
     */
    public function getStatusAfterAction(string $availableActions): int
    {
        return match ($availableActions) {
            self::ACTION_COMPLETION => self::STATUS_DONE, //2.5 Завершение задания, п. из ТЗ
            self::ACTION_REFUSAL => self::STATUS_FAILED, //2.6 Отказ от задания, п. из ТЗ
            self::ACTION_CANCEL => self::STATUS_CANCELLED, //2.7 Отмена задания, п. из ТЗ
            self::ACTION_ACCEPT => self::STATUS_ACTIVE, //2.8 Старт задания, п. из ТЗ
            default => self::STATUS_NEW,
        };
    }

    /**
     * Функция определяет список доступных действий в текущем статусе;
     * @param int $currentUserId
     * @return string|null
     */
    public function getAvailableActions(int $currentUserId): ?string
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                if ($currentUserId !== $this->customerId) {
                    return self::ACTION_RESPONSE;
                }
                return self::ACTION_CANCEL;

            case self::STATUS_ACTIVE:
                if ($currentUserId !== $this->customerId) {
                    return self::ACTION_REFUSAL;
                }
                return self::ACTION_COMPLETION;

            default:
                return null;
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
