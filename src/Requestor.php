<?php


namespace Victor78\SmsReg;

use Victor78\SmsReg\Exceptions\RequestException;
use Victor78\SmsReg\Validation\Validator;
use Victor78\SmsReg\Validation\ValidatorInterface;

/**
 * Class Requestor
 * @package Victor78\SmsReg
 * @link https://sms-reg.com/docs/API.html Sms-reg documentantion
 */
class Requestor
{
    /** @var string  */
    static private $base_url = 'http://api.sms-reg.com';


    /** @var string $api_key */
    private $api_key;

    /** @var string $dev_key */
    private $dev_key;

    /** @var ValidatorInterface */
    private $validator;

    /**
     * Requestor constructor.
     *
     * @param string                  $api_key
     * @param string|null             $dev_key
     * @param ValidatorInterface|null $validator - если нужно отключить превалидацию, использовать EmptyValidator
     */
    public function __construct(string $api_key, ?string $dev_key = null, ?ValidatorInterface $validator = null)
    {
        $this->setApiKey($api_key)
            ->setDevKey($dev_key)
            ->setValidator($validator);
    }

    /**
     * @param string $service
     * @param string $country
     *
     * @return array
     * @throws Exceptions\ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getNum(string $service, string $country = ''): array
    {
        $this->getValidator()->validateWithAlarm('service', $service);
        $params = [
            'service' => $service
        ];
        if ($country)
        {
            $this->getValidator()->validateWithAlarm('country', $country, 'getNum');
            $params['country'] = $country;
        }
        if ($this->getDevKey())
        {
            $params['appid'] = $this->getDevKey();
        }
        return $this->request('getNum', $params);
    }

    /**
     * @param int $tzid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setReady(int $tzid): array
    {
        $params = [
            'tzid' => $tzid,
        ];
        return $this->request('setReady', $params);
    }

    /**
     * @param int $tzid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getState(int $tzid): array
    {
        $params = [
            'tzid' => $tzid,
        ];
        return $this->request('getState', $params);
    }

    /**
     * @param string|null $opstate
     * @param int|null    $count
     * @param string|null $output
     *
     * @return array
     * @throws Exceptions\ValidationException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getOperations(?string $opstate = null, ?int $count = null, ?string $output = null): array
    {
        $params = [];
        if ($opstate)
        {
            $this->getValidator()->validateWithAlarm('opstate', $opstate);
            $params['opstate'] = $opstate;
        }
        if ($count)
        {
            $this->getValidator()->validateWithAlarm('count', $count);
            $params['count'] = $count;
        }
        if ($output)
        {
            $this->getValidator()->validateWithAlarm('output', $output);
            $params['output'] = $output;
        }
        return $this->request('getOperations', $params);
    }

    /**
     * @param int $tzid
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getNumRepeat(int $tzid): array
    {
        $params = [
            'tzid' => $tzid,
        ];
        return $this->request('getNumRepeat', $params);
    }

    /**
     * @param int|null $extended
     *
     * @return array
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getList(?int $extended = null): array
    {
        $params = [];
        if ($extended)
        {
            $params = [
                'extended' => 1
            ];
        }
        return $this->request('getList', $params);
    }

    /**
     * @param int $tzid
     *
     * @return array
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setOperationOk(int $tzid): array
    {
        $params = [
            'tzid' => $tzid,
        ];
        return $this->request('setOperationOk', $params);
    }

    /**
     * @param int $tzid
     *
     * @return array
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setOperationUsed(int $tzid): array
    {
        $params = [
            'tzid' => $tzid,
        ];
        return $this->request('setOperationUsed', $params);
    }

    /**
     * @param string $period
     * @param string $country
     *
     * @return array
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function vsimGet(string $period, string $country): array
    {
        $this->getValidator()->validateWithAlarm('period', $period);
        $params['period'] = $period;

        if ($country)
        {
            $this->getValidator()->validateWithAlarm('country', $country, 'vsimGet');
            $params['country'] = $country;
        }

        return $this->request('vsimGet', $params);
    }

    /**
     * @param int $number
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function vsimGetSMS(int $number): array
    {
        $params = [
            'number' => $number,
        ];
        return $this->request('vsimGetSMS', $params);
    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getBalance(): array
    {
        return $this->request('getBalance');
    }

    /**
     * @param float $rate
     *
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function setRate(float $rate): array
    {
        $params['rate'] = number_format($rate, 2, '.', '');
        return $this->request('setRate');
    }

    /**
     * @param string $method
     * @param array  $params
     *
     * @return array
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function request(string $method, array $params = []): array
    {
        $client = new \GuzzleHttp\Client();

        $params['apikey'] = $this->getApiKey();

        $query = http_build_query($params);

        $url = static::$base_url
               . '/' . $method . '.php'
               . '?' . $query;
        $response = $client->request('GET', $url);
        $response_body = $response->getBody();
        $response_array = json_decode($response_body, true);
        if (isset($response_array['response']) && $response_array['response'] == 'ERROR')
        {
            $error_message = '';
            if (isset($response_array['error_msg']))
            {
                $error_message = $response_array['error_msg'];
            }
            throw new RequestException($error_message);
        }
        return $response_array;

    }


    /**
     * @return string
     */
    private function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * @return string|null
     */
    private function getDevKey(): ?string
    {
        return $this->dev_key;
    }


    /**
     * @param string $api_key
     *
     * @return Requestor
     */
    private function setApiKey(string $api_key): Requestor
    {
        $this->api_key = $api_key;

        return $this;
    }


    /**
     * @param string $dev_key
     *
     * @return Requestor
     */
    private function setDevKey(?string $dev_key): Requestor
    {
        $this->dev_key = $dev_key;

        return $this;
    }

    /**
     * @param ValidatorInterface $validator
     *
     * @return Requestor
     */
    private function setValidator(?ValidatorInterface $validator): Requestor
    {
        if (!$validator)
        {
            $validator = new Validator();
        }
        $this->validator = $validator;

        return $this;
    }

    /**
     * @return ValidatorInterface
     */
    private function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }



}