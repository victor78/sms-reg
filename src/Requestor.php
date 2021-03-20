<?php


namespace Victor78\SmsReg;

use Victor78\SmsReg\Exceptions\RequestException;
use Victor78\SmsReg\Exceptions\ValidationException;
use Victor78\SmsReg\RequestExtract\abstraction\interfaces\RequestExtractInterface;

/**
 * Class Requestor
 * @package Victor78\SmsReg
 * @link https://sms-reg.com/docs/API.html Sms-reg documentantion
 * @method array getBalance()
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
 * @method array setRate(float $rate)
 */
class Requestor extends AbstractRequestor implements RequestorInterface
{
    /** @var string  */
    static protected $base_url = 'http://api.sms-reg.com';


    /**
     * @param $name
     * @param $arguments
     *
     * @return array
     * @throws RequestException
     * @throws ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     */
    public function __call($name, $arguments)
    {
        $extract = $this->createExtract($name, $arguments);
        return $this->request($extract);
    }

    /**
     * @param string $shortClassName
     * @param array  $params
     *
     * @return RequestExtractInterface
     * @throws ValidationException
     */
    private function createExtract(string $shortClassName, array $params): RequestExtractInterface
    {
        $extractClass  = "\\Victor78\\SmsReg\\RequestExtract\\specifics\\" . $shortClassName;

        if (!class_exists($extractClass))
        {
            throw new ValidationException("Method '$shortClassName' does not exist!'");
        }
        /** @var RequestExtractInterface $extract */
        $extract = new $extractClass(static::$base_url, $this->getApiKey(), $this->getDevKey());
        if ($this->isEnabledValidation())
        {
            $extract->enableValidation();
        }
        $extract->loadParams($params);

        return $extract;
    }
}