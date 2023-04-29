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
     * @return array<string>
     */
    public function validatePost(Post $post): array
    {
        $errors = $this->validator->validate($post);

        if (0 === \count($errors)) {
            return [];
        }

        $errorsString = [];
        try {
            foreach ($errors as $error) {
                $errorsString[] = (string) $error->getMessage();
            }
        } catch (\Throwable $throwable) {
            return [$throwable->getMessage()];
        }

        return $errorsString;
    }
}
