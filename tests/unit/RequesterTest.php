<?php

namespace Victor78\Tests\unit;
use Victor78\SmsReg\Requestor;

class RequestorTest extends \PHPUnit\Framework\TestCase
{
    static private $api_key = PHPUNIT_SMSREG_APIKEY;
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetBalance()
    {
        $requestor = new Requestor(self::$api_key);
        $response = $requestor->getBalance();
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('response', $response);
        $this->assertArrayHasKey('balance', $response);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Victor78\SmsReg\Exceptions\RequestException
     */
    public function testGetList()
    {
        $requestor = new Requestor(self::$api_key);
        $response = $requestor->getList();
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('services', $response);
        $this->assertGreaterThan(0, count($response));
    }
}
