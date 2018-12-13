<?php

declare(strict_types=1);

namespace Micro\Service\Domain\Repository;

interface RepositoryInterface
{
    public function page(int $page = 1, int $limit = 50): array;
}
