<?php

namespace Victor78\SmsReg\RequestExtract\abstraction\interfaces;

use Symfony\Component\Validator\Validator\ValidatorInterface;

interface RequestExtractInterface
{
    /**
     * RequestExtractInterface constructor.
     *
     * @param string      $base_url
     * @param string      $api_key
     * @param string|null $dev_key
     */
    public function __construct(string $base_url, string $api_key, ?string $dev_key = null);

    /**
     * @param array $params
     * Must set array to concrete fields
     *
     * @return RequestExtractInterface
     */
    public function loadParams(array $params): RequestExtractInterface;

    /**
     * @return string
     * @throws \ReflectionException
     */
    public function getEndpointUrl(): string;

    /**
     * @param ValidatorInterface $validator
     *
     * @return RequestExtractInterface
     */
    public function setValidator(ValidatorInterface $validator): RequestExtractInterface;

}