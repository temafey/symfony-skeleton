<?php

declare(strict_types=1);

namespace Micro\Service\Tests\Integration\Presentation\Http\Rest\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class JsonApiTestCase extends WebTestCase
{
    public const DEFAULT_EMAIL = 'test@test.com';

    public const DEFAULT_PASS = '1234567890';

    /** @var null|Client */
    protected $client;

    protected function setUp()
    {
        $this->client = static::createClient();
    }

    protected function post(string $uri, array $params)
    {
        $this->client->request(
            'POST',
            $uri,
            [],
            [],
            $this->headers(),
            (string) json_encode($params)
        );
    }

    protected function get(string $uri, array $parameters = [])
    {
        $this->client->request(
            'GET',
            $uri,
            $parameters,
            [],
            $this->headers()
        );
    }

    private function headers(): array
    {
        $headers = [
            'CONTENT_TYPE' => 'application/json',
        ];

        if ($this->token) {
            $headers['HTTP_Authorization'] = 'Bearer ' . $this->token;
        }

        return $headers;
    }

    protected function tearDown()
    {
        $this->client = null;
    }
}
