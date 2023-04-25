<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Post;
use App\Util\DTOSerializer;

class PostService
{
    private const ENDPOINT = 'posts';
    private DTOSerializer $serializer;

    public function __construct(
        private readonly ClientService $client
    ) {
        $this->serializer = new DTOSerializer();
    }

    public function getAll(): string
    {
        try {
            return $this->client->execute(ClientService::GET, self::ENDPOINT)->getContent();
        } catch (\Throwable $throwable) {
            return $throwable->getMessage();
        }
    }

    public function getOne(int $postId): ?Post
    {
        try {
            return $this->serializer->deserialize($this->client->execute(ClientService::GET, self::ENDPOINT.\DIRECTORY_SEPARATOR.$postId)->getContent(), Post::class, DTOSerializer::FORMAT_JSON);
        } catch (\Throwable $throwable) {
            return null;
        }
    }
}