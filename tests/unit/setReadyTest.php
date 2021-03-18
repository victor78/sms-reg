<?php

namespace Victor78\Tests\unit;


class setReadyTest extends CommonUnit
{

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /setReady\sto\sthis\sTZID\snot\sapplicable/
     */
    public function testSetReadyRequestException()
    {
        $this->requestor->setReady(1);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testSetReadyExceptionNotBlank()
    {
        $this->requestor->setReady();
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /integer/
     */
    public function testSetReadyExceptionTypeInt()
    {
        $this->requestor->setReady('ekus');
    }

}
