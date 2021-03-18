<?php

namespace Victor78\Tests\unit;

use Victor78\SmsReg\Requestor;

class getNumTest extends CommonUnit
{

    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /пустым/
     */
    public function testGetNumExceptionNotBlank()
    {
        $this->requestor->getNum();
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /недопустимо/
     */
    public function testGetNumExceptionServiceChoice()
    {
        $this->requestor->getNum('xxx');
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\ValidationException
     * @expectedExceptionMessageRegExp /недопустимо/
     */
    public function testGetNumExceptionCountryChoice()
    {
        $this->requestor->getNum('other', 'yyy');
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /недостаточно\sденег\sна\sсчету/
     */
    public function testGetNumRequestException()
    {
        $this->requestor->getNum('other', 'ru');
    }
    /**
     * @expectedException \Victor78\SmsReg\Exceptions\RequestException
     * @expectedExceptionMessageRegExp /недостаточно\sденег\sна\sсчету/
     */
    public function testGetNumDevKeyRequestException()
    {
        $this->requestor = new Requestor(self::$api_key, 'aaaa');
        $this->requestor->getNum('other', 'ru');
    }
}
