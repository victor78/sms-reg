<?php

namespace Victor78\Tests\unit;


class getStateTest extends CommonUnit
{


    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /TZID\swrong/
     */
    public function testGetStateRequestException()
    {
        $this->requestor->getState(1);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testGetStateExceptionNotBlank()
    {
        $this->requestor->getState();
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /integer/
     */
    public function testGetStateExceptionTypeInt()
    {
        $this->requestor->getState('ekus');
    }


}
