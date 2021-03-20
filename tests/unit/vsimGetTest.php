<?php

namespace Victor78\Tests\unit;


class vsimGetTest extends CommonUnit
{

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testVsimGetExceptionNotBlank()
    {
        $this->requestor->vsimGet();
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /недопустимо/
     */
    public function testVsimGetExceptionPeriodChoice()
    {
        $this->requestor->vsimGet('xxx');
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /недопустимо/
     */
    public function testVsimGetExceptionCountryChoice()
    {
        $this->requestor->vsimGet('other', 'yyy');
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /недостаточно\sденег\sна\sсчету/
     */
    public function testVsimGetRequestException()
    {
        $this->requestor->vsimGet('3hours', 'ru');
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /недостаточно\sденег\sна\sсчету/
     */
    public function testVsimGetDevKeyRequestException()
    {
        $this->requestor->vsimGet('week', 'pl');
    }
}
