<?php

declare(strict_types=1);

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class Post implements PostInterface
{
    private ?User $user = null;

    #[Assert\Positive]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    /**
     * @Serializer\Type("int")
     *
     * @Serializer\SerializedName("userId")
     */
    private int $userId;

    #[Assert\Positive]
    #[Assert\Type(
        type: 'integer',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    /**
     * @Serializer\Type("int")
     *
     * @Serializer\SerializedName("id")
     */
    private int $id;

    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    /**
     * @Serializer\Type("string")
     *
     * @Serializer\SerializedName("title")
     */
    private string $title;

    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    /**
     * @Serializer\Type("string")
     *
     * @Serializer\SerializedName("body")
     */
    private string $body;

    public function __construct(
        int $userId,
        int $id,
        string $title,
        string $body
    ) {
        $this->userId = $userId;
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
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
