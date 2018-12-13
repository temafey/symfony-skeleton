<?php

declare(strict_types=1);

namespace Micro\Service\Infrastructure\Event\Consumer;

use Micro\Service\Infrastructure\Event\Query\ElasticRepository;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class SendEventsToElasticConsumer implements ConsumerInterface
{
    /**
     * @var ElasticRepository
     */
    private $eventElasticRepository;

    public function __construct(ElasticRepository $eventElasticRepository)
    {
        $this->eventElasticRepository = $eventElasticRepository;
    }

    public function execute(AMQPMessage $msg): void
    {
        $this->eventElasticRepository->store(unserialize($msg->body));
    }
}
