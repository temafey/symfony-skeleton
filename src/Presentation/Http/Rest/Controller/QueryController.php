<?php

declare(strict_types=1);

namespace Micro\Service\Presentation\Http\Rest\Controller;

use League\Tactician\CommandBus;
use Micro\Service\Application\Query\Collection;
use Micro\Service\Application\Query\Item;
use Micro\Service\Presentation\Http\Rest\Response\JsonApiFormatter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class QueryController
{
    private const CACHE_MAX_AGE = 31536000; // Year.

    /**
     * @var JsonApiFormatter
     */
    private $formatter;

    /**
     * @var CommandBus
     */
    private $queryBus;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    public function __construct(CommandBus $queryBus, JsonApiFormatter $formatter, UrlGeneratorInterface $router)
    {
        $this->queryBus = $queryBus;
        $this->formatter = $formatter;
        $this->router = $router;
    }

    protected function ask($query)
    {
        return $this->queryBus->handle($query);
    }

    protected function jsonCollection(Collection $collection): JsonResponse
    {
        return JsonResponse::create($this->formatter::collection($collection));
    }

    protected function json(Item $resource): JsonResponse
    {
        return JsonResponse::create($this->formatter->one($resource));
    }

    protected function route(string $name, array $params = []): string
    {
        return $this->router->generate($name, $params);
    }
}
