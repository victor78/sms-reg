<?php

namespace Victor78\Tests\unit;


class setOperationOkTest extends CommonUnit
{


    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /to\sthis\sTZID\snot\sapplicable/
     */
    public function testSetOperationOkRequestException()
    {
        $this->requestor->setOperationOk(1);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testSetOperationOkExceptionNotBlank()
    {
        $this->requestor->setOperationOk();
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /integer/
     */
    public function testSetOperationOkExceptionTypeInt()
    {
        $this->requestor->setOperationOk('ekus');
    }


}
