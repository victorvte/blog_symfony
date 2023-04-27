<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\Post;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DTOValidatorService
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param Post $post
     * @return array<string>
     */
    public function validatePost(Post $post): array
    {
        $errors = $this->validator->validate($post);

        if (\count($errors) === 0) {
            return [];
        }

        $errorsString = [];
        foreach ($errors as $error) {
            $errorsString[] = $error->getMessage();
        }

        return $errorsString;
    }
}