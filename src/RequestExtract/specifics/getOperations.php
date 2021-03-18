<?php


namespace Victor78\SmsReg\RequestExtract\specifics;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Victor78\SmsReg\RequestExtract\abstraction\AbstractRequestExtract;
use Symfony\Component\Validator\Constraints;

class getOperations extends AbstractRequestExtract
{

    /**
     * @var string
     */
    public $opstate;
    /**
     * @var int
     */
    public $count;

    /**
     * @var string
     */
    public $output;

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('count', new Constraints\Type([
            'type' => 'integer',
        ]));

        $metadata->addPropertyConstraint('count', new Constraints\Range([
            'min' => 1,
            'max' => 1000,
        ]));

        $metadata->addPropertyConstraint('opstate', new Constraints\Choice([
            'choices' => [
                'active',
                'completed',
            ],
        ]));
        $metadata->addPropertyConstraint('output', new Constraints\Choice([
            'choices' => [
                'array',
                'object',
            ],
        ]));

    }


}