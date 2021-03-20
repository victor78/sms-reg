<?php


namespace Victor78\SmsReg\RequestExtract\specifics;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Victor78\SmsReg\RequestExtract\abstraction\AbstractRequestExtract;
use Symfony\Component\Validator\Constraints;

class vsimGet extends AbstractRequestExtract
{

    /**
     * @var string
     */
    public $period;

    /** @var string|null */
    public $country;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('period', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('country', new Constraints\Choice([
            'choices' => ['ru', 'ua', 'gb', 'bg', 'pl', 'hk'],
        ]));
        $metadata->addPropertyConstraint('period', new Constraints\Choice([
            'choices' => [
                '3hours',
                'day',
                'week',
            ],
        ]));
    }
}