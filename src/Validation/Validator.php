<?php


namespace Victor78\SmsReg\Validation;


use Victor78\SmsReg\Exceptions\ValidationException;

class Validator implements ValidatorInterface
{
    /**
     * @var array
     */
    static private $valids_for_country_in_getNum = [
        'ru', 'ua', 'kz', 'cn',
    ];
    /**
     * @var array
     */
    static private $valids_for_country_in_vsimGet = [
        'ru', 'ua', 'gb', 'bg', 'pl', 'hk',
    ];
    /**
     * @var array
     */
    static private $valids_for_service = [
        'aol',
        'gmail',
        'facebook',
        'mailru',
        'vk',
        'classmates',
        'twitter',
        'mamba',
        'uber',
        'telegram',
        'badoo',
        'drugvokrug',
        'avito',
        'olx',
        'steam',
        'fotostrana',
        'microsoft',
        'viber',
        'whatsapp',
        'wechat',
        'seosprint',
        'instagram',
        'yahoo',
        'lineme',
        'kakaotalk',
        'meetme',
        'tinder',
        'nimses',
        'youla',
        '5ka',
        'other',
    ];

    /**
     * @var array
     */
    static private $valids_for_opstate = [
        'active', 'completed',
    ];
    /**
     * @var array
     */
    static private $valids_for_output = [
        'array', 'object',
    ];
    static private $valids_for_period = [
        '3hours', 'day', 'week',
    ];

    /**
     * @param string $name
     * @param string $value
     * @param string $method
     *
     * @return bool
     */
    public static function isValid(string $name, string $value, string $method = ''): bool
    {
        $validation_method_name = "isValid" . ucfirst($name);
        if ($method)
        {
            $validation_method_name .= 'For' . ucfirst($method);
        }
        if (method_exists(self::class, $validation_method_name))
        {
            return self::$validation_method_name($value);
        }
        $array_name = 'valids_for_' . $name ;
        if ($method)
        {
            $array_name .= '_in_' . $method;
        }
        $available_values = self::$$array_name;
        return in_array($value, $available_values);
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public static function isValidCount(string $value): bool
    {
        if ($value > 0 && $value <= 1000)
        {
            return true;
        }
        return false;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @throws ValidationException
     */
    public static function validateWithAlarm(string $name, string $value, string $method = ''): void
    {
        if (!self::isValid($name, $value, $method))
        {
            throw new ValidationException($name
                                          . ' with value "'
                                          . $value . '" is not correct!');
        }
    }
}