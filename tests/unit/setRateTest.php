<?php

namespace Victor78\Tests\unit;


class setRateTest extends CommonUnit
{

    public function testSetRate()
    {
        $rate = 0.1;
        $response = $this->requestor->setRate($rate);
        $this->assertInternalType("array", $response);
        $this->assertArrayHasKey('response', $response);
        $this->assertArrayHasKey('rate', $response);

        $this->assertEquals($rate, $response['rate']);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /недопустимо/
     */
    public function testSetRateNegative()
    {
        $rate = -0.1;
        $this->requestor->setRate($rate);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testSetRateExceptionNotBlank()
    {
        $this->requestor->setRate();
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /float/
     */
    public function testSetRateExceptionTypeFloat()
    {
        $response = $this->requestor->setRate('ekus');
    }


}
