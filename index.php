<?php
require_once "vendor/autoload.php";


$requestor = new \Victor78\SmsReg\Requestor('z64hj45276ug9jldijectxm0s8i4mimb');
var_dump((new \ReflectionClass($requestor))->getMethods());
$response = $requestor->getBalance();