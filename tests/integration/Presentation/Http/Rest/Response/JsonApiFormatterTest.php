<?php

declare(strict_types=1);

namespace Micro\Service\Tests\Integration\Presentation\Http\Rest\Response;

use Micro\Service\Application\Query\Collection;
use Micro\Service\Application\Query\Item;
use Micro\Service\Domain\User\ValueObject\Email;
use Micro\Service\Infrastructure\User\Query\Projections\UserView;
use Micro\Service\Presentation\Http\Rest\Response\JsonApiFormatter;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class JsonApiFormatterTest extends TestCase
{
    /**
     * @test
     *
     * @group unit
     *
     * @throws \Assert\AssertionFailedException
     * @throws \Micro\Service\Domain\Shared\Query\Exception\NotFoundException
     */
    public function formatCollectionTest(): void
    {
        $users = [
            self::createUserView(Uuid::uuid4(), Email::fromString('asd1@asd.asd')),
            self::createUserView(Uuid::uuid4(), Email::fromString('asd2@asd.asd')),
        ];

        $response = JsonApiFormatter::collection(new Collection(1, 10, \count($users), $users));

        self::assertArrayHasKey('data', $response);
        self::assertArrayHasKey('meta', $response);
        self::assertArrayHasKey('total', $response['meta']);
        self::assertArrayHasKey('page', $response['meta']);
        self::assertArrayHasKey('size', $response['meta']);
        self::assertCount(2, $response['data']);
    }

    /**
     * @test
     *
     * @group unit
     *
     * @throws \Assert\AssertionFailedException
     */
    public function formatOneOutputTest(): void
    {
        $userView = self::createUserView(Uuid::uuid4(), Email::fromString('demo@asd.asd'));
        $response = JsonApiFormatter::one(new Item($userView));

        self::assertArrayHasKey('data', $response);
        self::assertSame('UserView', $response['data']['type']);
        self::assertCount(2, $response['data']['attributes']);
    }

    /**
     * @throws \Assert\AssertionFailedException
     */
    private static function createUserView(UuidInterface $uuid, Email $email): UserView
    {
        $view = UserView::deserialize([
            'uuid'        => $uuid->toString(),
            'credentials' => [
                'email'    => $email->toString(),
                'password' => 'ljalsjdlajsdljlajsd',
            ],
        ]);

        return $view;
    }
}
