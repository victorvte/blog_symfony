<?php

declare(strict_types=1);

namespace App\DTO;

interface PostInterface extends BaseInterface
{
    public function getId(): int;
    public function getUserId(): int;
    public function getTitle(): string;
    public function getBody(): string;
}