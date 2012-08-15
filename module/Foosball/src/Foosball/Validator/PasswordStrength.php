<?php

namespace Foosball\Validator;

use Zend\Validator\AbstractValidator;

class PasswordStrength extends AbstractValidator
{
    const UPPER = 'upper';
    const LOWER = 'lower';
    const DIGIT = 'digit';

    protected $messageTemplates = array(
        self::UPPER => "Must contain at least one upper case character",
        self::LOWER => "Must contain at least one lower case character",
        self::DIGIT => "Must contain at least one digit",
    );

    public function isValid($value)
    {
        $this->setValue($value);

        $isValid = true;

        if (!preg_match('/[A-Z]/', $value)) {
            $isValid = false;
            $this->error(self::UPPER);
        }

        if (!preg_match('/[a-z]/', $value)) {
            $isValid = false;
            $this->error(self::LOWER);
        }

        if (!preg_match('/[0-9]/', $value)) {
            $isValid = false;
            $this->error(self::DIGIT);
        }

        return $isValid;
    }
}