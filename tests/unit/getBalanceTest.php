<?php

namespace Victor78\Tests\unit;

class getBalanceTest extends CommonUnit
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testGetBalance()
    {

        $response = $this->requestor->getBalance();
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('response', $response);
        $this->assertArrayHasKey('balance', $response);
    }

}
