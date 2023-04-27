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

    /**
     * @return array<Post>
     */
    public function getAll(): array
    {
        try {
            $rawPosts = $this->client->execute(ClientService::GET, self::ENDPOINT)->getContent();

            /** @var array<Post> $posts */
            $posts = $this->serializer->deserialize(
                $rawPosts,
                'array<'.Post::class.'>',
                DTOSerializer::FORMAT_JSON
            );

            return $posts;
        } catch (\Throwable $throwable) {
            return [];
        }
    }

    public function getOne(int $postId): ?Post
    {
        try {
            return $this->serializer->deserialize(
                $this->client->execute(ClientService::GET, self::ENDPOINT.\DIRECTORY_SEPARATOR.$postId)->getContent(),
                Post::class,
                DTOSerializer::FORMAT_JSON
            );
        } catch (\Throwable $throwable) {
            return null;
        }
    }

    public function create(Post $post): string
    {
        try {
            $options = [
                'headers' => [
                    'Content-Type' => 'text/plain',
                ],
                'body' => $this->serializer->serialize($post, DTOSerializer::FORMAT_JSON),
            ];

            return $this->client->execute(
                ClientService::POST,
                self::ENDPOINT.\DIRECTORY_SEPARATOR,
                $options
            )->getContent();
        } catch (\Throwable $throwable) {
            return $throwable->getMessage();
        }
    }
}
