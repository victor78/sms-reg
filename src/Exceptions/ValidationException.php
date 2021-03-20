<?php


namespace Victor78\SmsReg\Exceptions;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends BaseException
{

    public function setMessageFromViolationList(ConstraintViolationListInterface $violationList, ?string $className): self
    {
        $text = "Ошибка валидации $className. ";
        /**
         * @var ConstraintViolationInterface $violation
         */
        foreach ($violationList as $violation)
        {
            $messages[] =
            $text .= 'Параметр ' . $violation->getPropertyPath() . ': "' . $violation->getMessage() . '" ';
        }

        $this->message = $text;

        return $this;
    }
}