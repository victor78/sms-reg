<?php


namespace Victor78\SmsReg\Validation;


use Victor78\SmsReg\Exceptions\ValidationException;

interface ValidatorInterface
{
    /**
     * @param string $name
     * @param string $value
     * @param string $method
     *
     * @return bool
     */
    public static function isValid(string $name, string $value, string $method = ''): bool;


    /**
     * @param string $name
     * @param string $value
     *
     * @throws ValidationException
     */
    public static function validateWithAlarm(string $name, string $value, string $method = ''): void;
}