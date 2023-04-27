<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use App\DTO\Post;
use App\DTO\User;
use App\Util\HydratePosts;
use PHPUnit\Framework\TestCase;

class HydratePostsTest extends TestCase
{
    /**
     * @dataProvider additionalHydratePostsSuccessProvider
     */
    public function testHydratePostsSuccess($posts, $users, $expected): void
    {
        $hydratedPosts = HydratePosts::hydrate($posts, $users);

        self::assertSame($expected, $hydratedPosts);
    }

    public static function additionalHydratePostsSuccessProvider(): \iterator
    {
        $postTitle = 'sunt aut facere repellat provident occaecati excepturi optio reprehenderit';
        $postBody = 'quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto';
        $post = new Post(1, 1, $postTitle, $postBody);

        $user = new User(1, 'Leanne Graham', 'Bret', 'Sincere@april.biz', 'hildegard.org');

        $postHydrated = $post;
        $postHydrated->setUser($user);

        yield 'hydrate' => [[$post], [$user], [$postHydrated]];
    }
}
