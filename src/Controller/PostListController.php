<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Post;
use App\Services\PostService;
use App\Util\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/',
    name: 'blog_list',
    condition: "context.getMethod() in ['GET', 'HEAD']"
)]
class PostListController extends AbstractController
{
    public function __invoke(DTOSerializer $serializer, PostService $postService): Response
    {
        /** @var array<Post> $posts */
        $posts = $serializer->deserialize($postService->getAll(), 'array<'.Post::class.'>', DTOSerializer::FORMAT_JSON);

        return $this->render('posts/list.html.twig', ['posts' => $posts]);
    }
}