<?php


namespace Victor78\SmsReg\Validation;


class EmptyValidator implements ValidatorInterface
{
    public static function isValid(string $name, string $value, string $method = ''): bool
    {
        return true;
    }

    public static function validateWithAlarm(string $name, string $value, string $method = ''): void
    {
        return;
    }

}