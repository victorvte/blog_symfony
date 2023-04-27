<?php

declare(strict_types=1);

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;

class Post implements PostInterface
{
    private ?User $user = null;

    /**
     * @Serializer\Type("int")
     *
     * @Serializer\SerializedName("userId")
     */
    private int $userId;

    public function __construct(
        int $userId,
        private int $id,
        private string $title,
        private string $body
    ) {
        $this->userId = $userId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }
}
