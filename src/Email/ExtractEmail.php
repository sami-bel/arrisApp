<?php

namespace App\Email;

class ExtractEmail implements ExtractEmailInterface
{

    public const FILE_EMl_EXTENSION = 'eml';
    /**
     * @var string
     */
    private $directoryFile;

    public function __construct(string $directoryFile)
    {
        $this->directoryFile = $directoryFile;
    }

    /**
     * @param string $filePath
     * @return EmailList
     * @throws invalidFileException
     */
    public function extract(string $filePath): EmailList
    {
        $path_parts = pathinfo($filePath);
        $filePath = $this->directoryFile.'/'.$path_parts['basename'];

        if (!$this->isValidFile($filePath))
        {
            throw new invalidFileException('file extension is not valid');
        }

        $emlContent = file_get_contents($filePath);
//        preg_match_all('/([A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6})/i', $emlContent, $matches, PREG_PATTERN_ORDER);
//        preg_match_all('~((\w* *){0,2})? +([A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6})|~i', $emlContent, $matches, PREG_PATTERN_ORDER);
        preg_match_all('~((\w* *){0,3} )?([A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6})~i', $emlContent, $matches, PREG_PATTERN_ORDER);

        $emails = [];
        $i = 0;


        foreach ($matches[3] as $email) {
            $fullName = $matches[1][$i];
            $email = new Email($fullName,$email);
            $emails[] = $email;
            $i++;
        }
        $emails = array_unique($emails);

        return new EmailList($emails);
    }

    public function isValidFile(string $filePath): bool
    {
        if (!file_exists($filePath))
        {
            return false;
        }
        $path_parts = pathinfo($filePath);

        return !(self::FILE_EMl_EXTENSION !== $path_parts['extension']);
    }

}