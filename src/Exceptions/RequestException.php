<?php

namespace Victor78\SmsReg\Exceptions;

use Throwable;

class RequestException extends BaseException
{
    private static $message_map = [
        'ERROR_KEY_NEED_CHANGE' => "YOUR_APIKEY требует замены",
        'ERROR_WRONG_KEY' => "YOUR_APIKEY неверный",
        'ERROR_NO_KEY' => "не указан ключ YOUR_APIKEY",
        'WARNING_LOW_BALANCE' => "недостаточно денег на счету",
        'Service not define' => "неопределен сервис",
        'TZID must be number' => "Значение TZID должно быть числом",
        'There is no TZID value' => "не указано TZID",
        'Wrong characters in parameters' => "недопустимые символы в передаваемых данных",
        'Rate change can be made when all current operations finished' => "Изменение ставки возможно после завершения всех операций",
    ];

    /**
     * RequestException constructor.
     *
     * @param string         $error_message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $error_message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->generateMessage($error_message), $code, $previous);
    }

    /**
     * @param string $error_message
     *
     * @return string
     */
    private function generateMessage(string $error_message): string
    {
        $error_message_prefix = 'Ошибка при обращении к API SMS-REG.com: ';

        if (isset(self::$message_map[$error_message]))
        {
            $error_message = self::$message_map[$error_message];
        }
        return $error_message_prefix . $error_message;
    }
}