<?php

namespace App\Email;

class EmailList
{
    private $emails;

    public function __construct(array $emails)
    {
        foreach ($emails as $email)
        {
            $this->addEmail($email);
        }
    }

    public function getEmails(): array
    {
        return $this->emails;
    }

    private function addEmail(Email $email): void
    {
        $this->emails[] = $email;
    }

}