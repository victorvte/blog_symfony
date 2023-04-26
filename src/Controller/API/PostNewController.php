<?php

declare(strict_types=1);

namespace App\Controller\API;

use App\DTO\Post;
use App\Services\PostService;
use App\Util\DTOSerializer;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    'api/post/new',
    name: 'api_post_new',
    methods: 'POST'
)]
#[OA\RequestBody(
    required: true,
    content: new OA\JsonContent(
        required: ['userId', 'id', 'title', 'body'],
        properties: [
            new OA\Property(property: 'userId', type: 'int'),
            new OA\Property(property: 'id', type: 'int'),
            new OA\Property(property: 'title', type: 'string'),
            new OA\Property(property: 'body', type: 'string'),
        ],
        type: 'object'
    )
)]
#[OA\Response(
    response: 200,
    description: 'Create a new Post',
    content: new Model(type: Post::class)
)]
#[OA\Response(
    response: '400',
    description: 'Invalid input'
)]
#[OA\Tag(name: 'Posts')]
class PostNewController extends AbstractController
{
    public function __invoke(
        Request $request,
        DTOSerializer $serializer,
        PostService $postService,
    ): JsonResponse {
        try {
            $post = $serializer->deserialize($request->getContent(), Post::class, DTOSerializer::FORMAT_JSON);

            //TODO: validate

            $response = $postService->create($post);
        } catch (\Throwable $throwable) {
            $response = $throwable->getMessage();
        }

        return new JsonResponse($response);
    }
}