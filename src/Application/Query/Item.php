<?php

declare(strict_types=1);

namespace Micro\Service\Application\Query;

use Broadway\ReadModel\SerializableReadModel;

final class Item
{
    /** @var string */
    public $id;

    /** @var string */
    public $type;

    /** @var array */
    public $resource;

    /** @var array */
    public $relationships = [];

    /** @var SerializableReadModel */
    public $readModel;

    public function __construct(SerializableReadModel $serializeReadModel, array $relations = [])
    {
        $this->id = $serializeReadModel->getId();
        $this->type = $this->type($serializeReadModel);
        $this->resource = $serializeReadModel->serialize();
        $this->relationships = $relations;
        $this->readModel = $serializeReadModel;
    }

    private function type(SerializableReadModel $model): string
    {
        $path = explode('\\', \get_class($model));

        return array_pop($path);
    }
}
