<?php


namespace Victor78\SmsReg\RequestExtract\specifics;


use Symfony\Component\Validator\Mapping\ClassMetadata;
use Victor78\SmsReg\RequestExtract\abstraction\AbstractRequestExtract;
use Symfony\Component\Validator\Constraints;
use Victor78\SmsReg\RequestExtract\abstraction\interfaces\RequestExtractInterface;

class setRate extends AbstractRequestExtract
{
    /**
     * float
     */
    public $rate;


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('rate', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('rate', new Constraints\Regex([
            'pattern' => '/^\d{1,13}\.\d{2}$/',
        ]));
    }
    public static function loadInputValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('rate', new Constraints\NotBlank());
        $metadata->addPropertyConstraint('rate', new Constraints\Type([
            'type' => 'float',
        ]));
    }


    public function loadParams(array $params): RequestExtractInterface
    {
        parent::loadParams($params);
        $this->validate(true);
        $rate = number_format($this->rate, 2, '.', '');
        $this->loadParam('rate', $rate);
        return $this;
    }
}