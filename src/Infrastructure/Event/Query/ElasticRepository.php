<?php

declare(strict_types=1);

namespace Micro\Service\Infrastructure\Event\Query;

use Broadway\Domain\DomainMessage;
use Micro\Service\Domain\Repository\RepositoryInterface;
use Micro\Service\Infrastructure\Query\Repository\ElasticRepository as AbstractRepository;

abstract class ElasticRepository extends AbstractRepository implements RepositoryInterface
{
    /**
     * Elasticsearch resource index name
     * @var string
     */
    protected $index;

    public function __construct(array $elasticConfig)
    {
        parent::__construct($elasticConfig, $this->index);
    }

    public function store(DomainMessage $message): void
    {
        $document = [
            'type'        => $message->getType(),
            'payload'     => $message->getPayload()->serialize(),
            'occurred_on' => $message->getRecordedOn()->toString(),
        ];
        $this->add($document);
    }
}
