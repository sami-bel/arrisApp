<?php

namespace App\Email;

class Email
{
    private $fullName;

    private $value;

    public function __construct($fullName, $value)
    {
        $this->fullName = $fullName;
        $this->value = $value;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->fullName.' '.$this->getValue();
    }
}