<?php

namespace App\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Twig\Environment;

class IndexController
{
    /**
     * @var Environment
     */
    private $template;

    public function __construct(Environment $template)
    {

        $this->template = $template;
    }

    public function test(): ResponseInterface
    {
        return new Response(
            200,
            [],
            $this->template->render('base.html.twig'));
    }
}