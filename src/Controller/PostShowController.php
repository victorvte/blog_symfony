<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Post;
use App\DTO\User;
use App\Services\PostService;
use App\Services\UserService;
use App\Util\DTOSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(
    '/posts/{id}',
    name: 'post_show',
    condition: "params['id'] < 100"
)]
class PostShowController extends AbstractController
{
    public function __invoke(
        int $id,
        DTOSerializer $serializer,
        PostService $postService,
        UserService $userService,
    ): Response {
        try {
            /** @var Post $post */
            $post = $postService->getOne($id);
            if (!$post){
                $this->redirectToRoute('blog_list');
            }

            /** @var User $user */
            $user = $userService->getOne($post->getUserId());

            $post->setUser($user);

        } catch (\Throwable $throwable) {
            $this->redirectToRoute('blog_list');
        }

        return $this->render('posts/show.html.twig', ['post' => $post]);
    }
}