<?php

declare(strict_types=1);

namespace App\Util;

use App\DTO\Post;
use App\DTO\User;

class HydratePosts
{
    /**
     * @param array<Post> $posts
     * @param array<User> $users
     * @return array<Post>
     */
    public function hydrate(array $posts, array $users): array
    {
        $usersIndexedById = [];
        foreach ($users as $user) {
            $usersIndexedById[$user->getId()] = $user;
        }

        foreach ($posts as $post) {
            $post->setUser($usersIndexedById[$post->getUserId()]);
        }

        return $posts;
    }
}