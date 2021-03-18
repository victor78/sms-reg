<?php

namespace Victor78\Tests\unit;

use Victor78\SmsReg\Requestor;
use Victor78\SmsReg\RequestorInterface;

class CommonUnit extends \PHPUnit\Framework\TestCase
{
    static protected $api_key = PHPUNIT_SMSREG_APIKEY;

    /**
     * @var RequestorInterface
     */
    protected $requestor;

    protected function setUp()
    {
        $this->requestor = new Requestor(self::$api_key);
    }

}
