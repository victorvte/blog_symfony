<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\User;
use App\Util\DTOSerializer;

class UserService
{
    private const ENDPOINT = 'users';

    private DTOSerializer $serializer;

    public function __construct(
        private readonly ClientService $client
    ) {
        $this->serializer = new DTOSerializer();
    }

    /**
     * @return array<User>
     */
    public function getAll(): array
    {
        try {
            return $this->serializer->deserialize($this->client->execute(ClientService::GET, self::ENDPOINT)->getContent(), 'array<'.User::class.'>', DTOSerializer::FORMAT_JSON);
        } catch (\Throwable $throwable) {
            return [];
        }
    }

    public function getOne(int $id): ?User
    {
        try {
            return $this->serializer->deserialize($this->client->execute(ClientService::GET, self::ENDPOINT.\DIRECTORY_SEPARATOR.$id)->getContent(), User::class, DTOSerializer::FORMAT_JSON);
        } catch (\Throwable $throwable) {
            return null;
        }
    }
}