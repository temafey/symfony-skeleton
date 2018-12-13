<?php

declare(strict_types=1);

namespace Micro\User\Tests\Unit\Infrastructure\Event\Publisher;

use Broadway\Domain\DomainMessage;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumerMock implements ConsumerInterface
{
    /** @var DomainMessage|null */
    private $message;

    public function getMessage(): ?DomainMessage
    {
        return $this->message;
    }

    public function execute(AMQPMessage $msg)
    {
        $this->message = unserialize($msg->body);
    }
}
