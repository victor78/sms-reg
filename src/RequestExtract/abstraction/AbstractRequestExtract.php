<?php


namespace Victor78\SmsReg\RequestExtract\abstraction;

use Victor78\SmsReg\Exceptions\ValidationException;
use Victor78\SmsReg\RequestExtract\abstraction\interfaces\RequestExtractInterface;
use \Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequestExtract implements RequestExtractInterface
{
    /**
     * @var string
     */
    protected $base_url;
    /**
     * @var string
     */
    protected $api_key;
    /**
     * @var string|null
     */
    protected $dev_key;

    /** @var array  */
    protected $params = [];

    /**
     * @var ValidatorInterface|null
     */
    protected $validator = null;

    /**
     * AbstractRequestExtract constructor.
     *
     * @param string      $base_url
     * @param string      $api_key
     * @param string|null $dev_key
     */
    public function __construct(string $base_url, string $api_key, ?string $dev_key = null)
    {
        $this->setBaseUrl($base_url)
            ->setApiKey($api_key)
            ->setDevKey($dev_key);

    }


    /**
     * @param array $params
     *
     * @return RequestExtractInterface
     * @throws \ReflectionException
     */
    public function loadParams(array $params): RequestExtractInterface
    {
        $properties = (new \ReflectionClass($this))->getProperties(\ReflectionProperty::IS_PUBLIC);
        $propertiesNames = array_map(function(\ReflectionProperty $property){
            return $property->name;
        }, $properties);

        foreach ($params as $key => $value)
        {
            $field = $propertiesNames[$key];
            $this->{$field} = $value;
            $this->params[$field] = $value;
        }
        return $this;
    }

    public function loadParam(string $name, string $value): RequestExtractInterface
    {
        $this->{$name} = $value;
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * @return string
     * @throws ValidationException
     * @throws \ReflectionException
     */
    public function getEndpointUrl(): string
    {
        $params = $this->getParams();

        $query = http_build_query($params);

        $method = (new \ReflectionClass($this))->getShortName();

        $url = $this->getBaseUrl()
               . '/' . $method . '.php'
               . '?' . $query;
        return $url;
    }

    /**
     * @param ValidatorInterface|null $validator
     *
     * @return RequestExtractInterface
     */
    public function setValidator(?ValidatorInterface $validator): RequestExtractInterface
    {
        $this->validator = $validator;
        return $this;
    }


    /**
     * @return array
     * @throws ValidationException
     * @throws \ReflectionException
     */
    protected function getParams(): array
    {
        $this->validate();
        $params = $this->params;
        $params['apikey'] = $this->getApiKey();
        return $params;
    }

    /**
     * @throws ValidationException
     * @throws \ReflectionException
     */
    protected function validate(): void
    {
        if ($this->validator)
        {
            $violations = $this->validator->validate($this);

            if ($violations->count())
            {
                $class = (new \ReflectionClass($this))->getShortName();
                throw ValidationException::createFromViolationList($violations, $class);
            }
        }
    }


    /**
     * @return string|null
     */
    protected function getDevKey(): ?string
    {
        return $this->dev_key;
    }

    /**
     * @param string|null $dev_key
     *
     * @return AbstractRequestExtract
     */
    private function setDevKey(?string $dev_key): AbstractRequestExtract
    {
        $this->dev_key = $dev_key;

        return $this;
    }

    /**
     * @return string
     */
    private function getBaseUrl(): string
    {
        return $this->base_url;
    }

    /**
     * @param string $base_url
     *
     * @return AbstractRequestExtract
     */
    private function setBaseUrl(string $base_url): AbstractRequestExtract
    {
        $this->base_url = $base_url;

        return $this;
    }

    /**
     * @return string
     */
    private function getApiKey(): string
    {
        return $this->api_key;
    }

    /**
     * @param string $api_key
     *
     * @return AbstractRequestExtract
     */
    private function setApiKey(string $api_key): AbstractRequestExtract
    {
        $this->api_key = $api_key;

        return $this;
    }


}