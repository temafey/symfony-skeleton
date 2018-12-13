<?php

declare(strict_types=1);

namespace Micro\Service\Presentation\Http\Web\Controller;

use League\Tactician\CommandBus;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractRenderController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var CommandBus
     */
    private $queryBus;

    /**
     * @var \Twig_Environment
     */
    private $template;

    public function __construct(\Twig_Environment $template, CommandBus $commandBus, CommandBus $queryBus)
    {
        $this->template = $template;
        $this->commandBus = $commandBus;
        $this->queryBus = $queryBus;
    }

    /**
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function render(string $view, array $parameters = [], int $code = Response::HTTP_OK): Response
    {
        $content = $this->template->render($view, $parameters);

        return new Response($content, $code);
    }

    protected function exec($command): void
    {
        $this->commandBus->handle($command);
    }

    protected function ask($query)
    {
        return $this->queryBus->handle($query);
    }
}
