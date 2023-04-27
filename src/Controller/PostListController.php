<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Post;
use App\Services\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/',
    name: 'blog_list',
    methods: 'GET'
)]
class PostListController extends AbstractController
{
    public function __invoke(PostService $postService): Response
    {
        /** @var array<Post> $posts */
        $posts = $postService->getAll();

        return $this->render('posts/list.html.twig', ['posts' => $posts]);
    }
}
