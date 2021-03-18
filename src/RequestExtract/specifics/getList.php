<?php


namespace Victor78\SmsReg\RequestExtract\specifics;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Victor78\SmsReg\RequestExtract\abstraction\AbstractRequestExtract;
use Symfony\Component\Validator\Constraints;

class getList extends AbstractRequestExtract
{

    /**
     * int
     */
    public $extended;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('extended', new Constraints\Choice([
            'choices' => [0, 1],
        ]));
    }


}