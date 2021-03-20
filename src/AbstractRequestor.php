<?php


namespace Victor78\SmsReg;

use Victor78\SmsReg\Exceptions\RequestException;
use Victor78\SmsReg\RequestExtract\abstraction\interfaces\RequestExtractInterface;

abstract class AbstractRequestor implements RequestorInterface
{
    /** @var string  */
    static protected $base_url = 'http://api.sms-reg.com';


    /** @var string $api_key */
    private $api_key;

    /** @var string $dev_key */
    private $dev_key;

    /**
     * @var bool
     */
    private $enabledValidation;

    /**
     * AbstractRequestor constructor.
     *
     * @param string      $api_key
     * @param string|null $dev_key
     * @param bool        $enabledValidation
     */
    public function __construct(string $api_key, ?string $dev_key = null, bool $enabledValidation = true)
    {
        $this->setApiKey($api_key)
            ->setDevKey($dev_key)
            ->setEnabledValidation($enabledValidation);
    }

    /**
     * @param RequestExtractInterface $extract
     *
     * @return array
     * @throws RequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \ReflectionException
     */
    protected function request(RequestExtractInterface $extract): array
    {
        $client = new \GuzzleHttp\Client();


        $url = $extract->getEndpointUrl();
        $response = $client->request('GET', $url);
        $response_body = $response->getBody();
        $response_array = json_decode($response_body, true);
        $this->validate($response_array);

        return $response_array;
    }

    /**
     * @param array|null $response_array
     *
     * @throws RequestException
     */
    protected function validate(?array $response_array): void
    {
        if (isset($response_array['response']) && ($response_array['response'] == 'ERROR' || $response_array['response'] == 0 ))
        {
            $error_message = '';
            if (isset($response_array['error_msg']))
            {
                $error_message = $response_array['error_msg'];
            }
            throw new RequestException($error_message);
        }
    }

    /**
     * @return string
     */
    protected function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * @return string|null
     */
    protected function getDevKey(): ?string
    {
        return $this->dev_key;
    }


    /**
     * @param string $api_key
     *
     * @return RequestorInterface|AbstractRequestor
     */
    protected function setApiKey(string $api_key): AbstractRequestor
    {
        $this->api_key = $api_key;

        return $this;
    }


    /**
     * @param string $dev_key
     *
     * @return Requestor
     */
    protected function setDevKey(?string $dev_key): AbstractRequestor
    {
        $this->dev_key = $dev_key;

        return $this;
    }

    /**
     * @param bool $enabledValidation
     *
     * @return AbstractRequestor
     */
    protected function setEnabledValidation(bool $enabledValidation): AbstractRequestor
    {
        $this->enabledValidation = $enabledValidation;

        return $this;
    }

    /**
     * @return bool
     */
    protected function isEnabledValidation(): bool
    {
        return $this->enabledValidation;
    }

}