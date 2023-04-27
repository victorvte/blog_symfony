<?php

declare(strict_types=1);

namespace App\DTO;

interface UserInterface extends BaseInterface
{
    public function getName(): string;

    public function getUsername(): string;

    public function getEmail(): string;
}
