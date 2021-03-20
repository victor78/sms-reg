<?php

namespace Victor78\Tests\unit;


class getNumRepeatTest extends CommonUnit
{


    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     */
    public function testGetNumRepeatRequestException()
    {
        $this->requestor->getNumRepeat(1);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testGetNumRepeatExceptionNotBlank()
    {
        $this->requestor->getNumRepeat();
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /integer/
     */
    public function testGetNumRepeatExceptionTypeInt()
    {
        $this->requestor->getNumRepeat('ekus');
    }


}
