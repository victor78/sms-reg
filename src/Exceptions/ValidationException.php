<?php


namespace Victor78\SmsReg\Exceptions;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends BaseException
{
    public static function createFromViolationList(ConstraintViolationListInterface $violationList, ?string $className): self
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



        $exception = new self($text);
        return $exception;
    }
}