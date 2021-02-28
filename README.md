# Sms-reg PHP API SDK
Удобная обертка для запросов к API sms-reg.com

## Установка

Установка при помощи [Composer](https://getcomposer.org). Выполните команду в корневом каталоге проекта:

```
composer require victor78/sms-reg
```

## Использование

Класс для взаимодействия с API - **Victor78/SmsReg/Requestor**.
Все его публичные методы носят имена аутентичных методов API согласно документации https://sms-reg.com/docs/API.html

```php
<?php
use Victor78/SmsReg/Requestor;

$api_key = 'somekey'; //необходимо получить в личном кабинете сервиса sms-reg
$requestor = new Requester($api_key);
$balance_response = $requestor->getBalance();
$balance = (float) $balance_response['balance'];
$list_response = $requestor->getList(1);
$services = $list_response['services'];
```

##Тесты
Выполнить команду 
```
vendor/bin/phpunit
```
 
Для проверки со своим API KEY, в phpunit.xml указать актуальное значение **PHPUNIT_SMSREG_APIKEY**. 