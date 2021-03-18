<?php

namespace Victor78\Tests\unit;


class getOperations extends CommonUnit
{

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /No\sactive\stranzactions/
     */
    public function testGetOperationsRequestException()
    {
        $this->requestor->getOperations();
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /недопустимо/
     */
    public function testGetOperationsExceptionOpstateChoice()
    {
        $this->requestor->getOperations(1);
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /integer/
     */
    public function testGetOperationsExceptionCountTypeInt()
    {
        $this->requestor->getOperations(null, 'ekus');
    }

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /count\:\s\".*1\sи\s1000/
     */
    public function testGetOperationsExceptionCountRange()
    {
        $this->requestor->getOperations(null, 0);
    }

}
