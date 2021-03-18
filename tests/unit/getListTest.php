<?php

namespace Victor78\Tests\unit;


class getListTest extends CommonUnit
{

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Victor78\SmsReg\Exceptions\RequestException
     */
    public function testGetList()
    {
        $response = $this->requestor->getList();
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('services', $response);
        $this->assertGreaterThan(0, count($response));

        $response = $this->requestor->getList(1);
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('services', $response);
        $this->assertGreaterThan(0, count($response));

    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /недопустимо/
     */
    public function testGetListException()
    {
        $this->requestor->getList(2);
    }


}
