<?php

declare(strict_types=1);

namespace Micro\Service\Presentation\Http\Rest\Controller;

use League\Tactician\CommandBus;

abstract class CommandController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    protected function exec($command): void
    {
        $this->commandBus->handle($command);
    }
}
