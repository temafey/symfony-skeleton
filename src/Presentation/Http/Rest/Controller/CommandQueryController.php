<?php

declare(strict_types=1);

namespace Micro\Service\Presentation\Http\Rest\Controller;

use League\Tactician\CommandBus;
use Micro\Service\Presentation\Http\Rest\Response\JsonApiFormatter;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CommandQueryController extends QueryController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(
        CommandBus $commandBus,
        CommandBus $queryBus,
        JsonApiFormatter $formatter,
        UrlGeneratorInterface $router
    ) {
        parent::__construct($queryBus, $formatter, $router);
        $this->commandBus = $commandBus;
    }

    protected function exec($command): void
    {
        $this->commandBus->handle($command);
    }
}
