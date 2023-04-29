<?php

declare(strict_types=1);

namespace App\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class User implements UserInterface
{
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
     * @Serializer\SerializedName("name")
     */
    private string $name;

    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    /**
     * @Serializer\Type("string")
     *
     * @Serializer\SerializedName("username")
     */
    private string $username;

    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    /**
     * @Serializer\Type("string")
     *
     * @Serializer\SerializedName("email")
     */
    private string $email;

    #[Assert\Type(
        type: 'string',
        message: 'The value {{ value }} is not a valid {{ type }}.',
    )]
    /**
     * @Serializer\Type("string")
     *
     * @Serializer\SerializedName("website")
     */
    private string $website;

    public function __construct(
        int $id,
        string $name,
        string $username,
        string $email,
        string $website
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->website = $website;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }
}
