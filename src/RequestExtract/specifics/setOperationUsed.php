<?php


namespace Victor78\SmsReg\RequestExtract\specifics;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Victor78\SmsReg\RequestExtract\abstraction\AbstractRequestExtract;
use Symfony\Component\Validator\Constraints;

class setOperationUsed extends AbstractRequestExtract
{

    /**
     * int
     */
    public $tzid;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('tzid', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('tzid', new Constraints\Type([
            'type' => 'integer',
        ]));
    }

}