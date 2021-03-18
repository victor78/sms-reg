<?php


namespace Victor78\SmsReg\RequestExtract\specifics;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Victor78\SmsReg\RequestExtract\abstraction\AbstractRequestExtract;
use Symfony\Component\Validator\Constraints;
use Victor78\SmsReg\RequestExtract\abstraction\interfaces\RequestExtractInterface;

class getNum extends AbstractRequestExtract
{

    /**
     * @var string
     */
    public $service;

    /** @var string|null */
    public $country;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('service', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('country', new Constraints\Choice([
            'choices' => ['ru', 'ua', 'kz', 'cn'],
        ]));
        $metadata->addPropertyConstraint('service', new Constraints\Choice([
            'choices' => [
                'aol',
                'gmail',
                'facebook',
                'mailru',
                'vk',
                'classmates',
                'twitter',
                'mamba',
                'uber',
                'telegram',
                'badoo',
                'drugvokrug',
                'avito',
                'olx',
                'steam',
                'fotostrana',
                'microsoft',
                'viber',
                'whatsapp',
                'wechat',
                'seosprint',
                'instagram',
                'yahoo',
                'lineme',
                'kakaotalk',
                'meetme',
                'tinder',
                'nimses',
                'youla',
                '5ka',
                'other',
            ],
        ]));
    }

    public function loadParams(array $params): RequestExtractInterface
    {
        parent::loadParams($params);
        if ($this->getDevKey())
        {
            $this->loadParam('appid', $this->getDevKey());
        }
        return $this;
    }
}