<?php

namespace App\Controller\Email;

use App\Email\ExtractEmailInterface;
use http\Exception\InvalidArgumentException;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class EmailExtractorController
{
    /**
     * @var Environment
     */
    private $template;
    /**
     * @var ExtractEmailInterface
     */
    private $extractEmail;
    /**
     * @var string
     */
    private $directoryFile;

    public function __construct(ExtractEmailInterface $extractEmail, Environment $template, string $directoryFile)
    {
        $this->extractEmail = $extractEmail;
        $this->template = $template;
        $this->directoryFile = $directoryFile;
    }

    public function home(): ResponseInterface
    {
        return new Response(
            200,
            [],
            $this->template->render('email/email_extractor.html.twig'));
    }

    public function extract(ServerRequestInterface  $request): ResponseInterface
    {

        $data = $request->getParsedBody();



        if (!key_exists('filename', $data)) {
            throw new \InvalidArgumentException ('path key is not exist');
        }

        $emails = $this->extractEmail->extract($data['filename']);

        return new Response(
            200,
            [],
            $this->template->render(
                'email/email_list.html.twig',
                [
                    'emails' => $emails->getEmails()
                ]
            ));
    }
}