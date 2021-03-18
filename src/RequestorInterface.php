<?php

namespace Victor78\SmsReg;


use Victor78\SmsReg\Exceptions\RequestException;

/**
 * Class Requestor
 * @package Victor78\SmsReg
 * @link    https://sms-reg.com/docs/API.html Sms-reg documentantion
 * @method array getNum(string $service, string $country = '')
 * @method array setReady(int $tzid)
 * @method array getState(int $tzid)
 * @method array getOperations(?string $opstate = null, ?int $count = null, ?string $output = null)
 * @method array getNumRepeat(int $tzid)
 * @method array getList(?int $extended = null)
 * @method array setOperationOk(int $tzid)
 * @method array setOperationUsed(int $tzid)
 * @method array vsimGet(string $period, string $country)
 * @method array vsimGetSMS(int $number)
 * @method array getBalance()
 * @method array setRate(float $rate)
 */
interface RequestorInterface
{

}