<?php

declare(strict_types=1);

namespace App\Services;

use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ClientService
{
    public const POST = 'POST';
    public const GET = 'GET';

    public function __construct(
        private readonly string $apiUrl,
        private readonly HttpClientInterface $client
    ) {
    }

    /**
     * @param array<mixed> $options
     *
     * @throws TransportExceptionInterface
     */
    public function execute(string $method, string $endpoint, array $options = []): ResponseInterface
    {
        return $this->client->request(
            $method,
            $this->apiUrl.\DIRECTORY_SEPARATOR.$endpoint,
            $options
        );
    }
}
