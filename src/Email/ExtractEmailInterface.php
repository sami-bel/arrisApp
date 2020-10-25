<?php

namespace App\Email;

interface ExtractEmailInterface
{
    public function extract(string $filePath): EmailList;
}