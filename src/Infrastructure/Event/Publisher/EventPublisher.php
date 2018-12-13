<?php

declare(strict_types=1);

namespace Micro\Service\Infrastructure\Event\Publisher;

use Broadway\Domain\DomainMessage;

interface EventPublisher
{
    public function handle(DomainMessage $message): void;

    public function publish(): void;
}
