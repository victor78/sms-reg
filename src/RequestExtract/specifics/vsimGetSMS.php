<?php


namespace Victor78\SmsReg\RequestExtract\specifics;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Victor78\SmsReg\RequestExtract\abstraction\AbstractRequestExtract;
use Symfony\Component\Validator\Constraints;

class vsimGetSMS extends AbstractRequestExtract
{

    /**
     * int
     */
    public $number;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('number', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('number', new Constraints\Type([
            'type' => 'integer',
        ]));
    }


}