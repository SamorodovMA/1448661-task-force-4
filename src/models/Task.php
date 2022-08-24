<?php
namespace tf\models;

class Task
{
    const STATUS_NEW = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_WORKING = 3;
    const STATUS_DONE = 4;
    const STATUS_FAILED = 5;

    const ACTION_START = 'start'; //Старт задания п.28 (кнопка принять)
    const ACTION_CANCEL = 'cancel'; // Отмена задания п.2.7
    const ACTION_REFUSE = 'refuse'; //Отказаться от задания п.26
    const ACTION_COMPLETE = 'complete'; //Завершение задания п2.5
    const ACTION_RESPONSE = 'response'; //Добавление отклика п.2.4
    const ACTION_REJECT = 'reject'; //Отказать исполнителю (кнопка отказать)

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
                self::STATUS_WORKING => 'В работе',
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
                self::ACTION_START => 'Принять', // Принят заявку от исполнителя (кнопка приять)
                self::ACTION_CANCEL => 'Отмена задания',
                self::ACTION_RESPONSE => 'Откликнуться на задание',
                self::ACTION_REFUSE => 'Отказаться от задания',
                self::ACTION_COMPLETE => 'Завершить задание, выполнено',
                self::ACTION_REJECT => 'Отказать' //Отказать исполнителю (кнопка отказать)
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
            self::ACTION_COMPLETE => self::STATUS_DONE, //2.5 Завершение задания, п. из ТЗ
            self::ACTION_REFUSE => self::STATUS_FAILED, //2.6 Отказ от задания, п. из ТЗ
            self::ACTION_CANCEL => self::STATUS_CANCELLED, //2.7 Отмена задания, п. из ТЗ
            self::ACTION_START => self::STATUS_WORKING, //2.8 Старт задания, п. из ТЗ
            default => self::STATUS_NEW
        };
    }

    /**
     * * Функция определяет список доступных действий в текущем статусе;
     * @param int $currentUserId
     * @return array
     */
    public function getAvailableActions(int $currentUserId): array
    {
        switch ($this->status) {
            case self::STATUS_NEW:
                if ($currentUserId === $this->customerId) {
                    return [new ActionStart(), new ActionCancel()];
                } elseif ($currentUserId === $this->executorId) {
                    return [new ActionResponse()];
                }
                break;

            case self::STATUS_WORKING:
                if ($currentUserId === $this->customerId) {
                    return [new ActionComplete()];
                } elseif ($currentUserId === $this->executorId) {
                    return [new ActionRefuse()];
                }
                break;
        }
        return [];
    }

    /**
     * Функция возвращает текущий статус задания;
     * @return int
     */
public function getCurrentStatus():int
{
    return $this->status;
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
