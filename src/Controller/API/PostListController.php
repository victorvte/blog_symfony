<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\DTO\Post;
use App\Services\PostService;
use App\Services\UserService;
use App\Util\DTOSerializer;
use App\Util\HydratePosts;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    'api/blog/list',
    name: 'api_blog_list',
    methods: 'GET'
)]
#[OA\Response(
    response: 200,
    description: 'Return list of posts',
    content: new OA\JsonContent(
        type: 'array',
        items: new OA\Items(ref: new Model(type: Post::class))
    )
)]
#[OA\Tag(name: 'Posts')]
class PostListController extends AbstractController
{
    public function __invoke(
        DTOSerializer $serializer,
        PostService $postService,
        UserService $userService,
        HydratePosts $hydratePostsService
    ): JsonResponse {
        try {
            $posts = $hydratePostsService->hydrate($postService->getAll(), $userService->getAll());

            $response = $serializer->serialize($posts, DTOSerializer::FORMAT_JSON);
        } catch (\Throwable $e) {
            $response = 'Data not found';
        }

        return new JsonResponse($response);
    }
}