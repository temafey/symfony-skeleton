<?php

declare(strict_types=1);

namespace Micro\Service\Tests\Unit\Application;

use League\Tactician\CommandBus;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

abstract class ApplicationTestCase extends KernelTestCase
{
    /**
     * @var CommandBus|null
     */
    private $commandBus;

    /**
     * @var CommandBus|null
     */
    private $queryBus;

    protected function setUp()
    {
        static::bootKernel();

        $this->commandBus = $this->service('tactician.commandbus.command');
        $this->queryBus = $this->service('tactician.commandbus.query');
    }

    /**
     * Executes the given command and optionally returns a value.
     */
    protected function ask(object $query)
    {
        return $this->queryBus->handle($query);
    }

    /**
     * Executes the given command and optionally returns a value.
     */
    protected function handle(object $command): void
    {
        $this->commandBus->handle($command);
    }

    /**
     * Get and return service from Service Container.
     */
    protected function service(string $serviceId)
    {
        return self::$container->get($serviceId);
    }

    protected function fireTerminateEvent(): void
    {
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->service('event_dispatcher');

        $dispatcher->dispatch(
            KernelEvents::TERMINATE,
            new PostResponseEvent(
                static::$kernel,
                Request::create('/'),
                Response::create()
            )
        );
    }

    protected function tearDown()
    {
        $this->commandBus = null;
        $this->queryBus = null;
    }
}
