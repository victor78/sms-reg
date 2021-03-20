<?php

namespace Victor78\Tests\unit;


class setOperationUsedTest extends CommonUnit
{


    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /to\sthis\sTZID\snot\sapplicable/
     */
    public function testSetOperationUsedRequestException()
    {
        $this->requestor->setOperationUsed(1);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testSetOperationUsedExceptionNotBlank()
    {
        $this->requestor->setOperationUsed();
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /integer/
     */
    public function testSetOperationUsedExceptionTypeInt()
    {
        $this->requestor->setOperationUsed('ekus');
    }


}
