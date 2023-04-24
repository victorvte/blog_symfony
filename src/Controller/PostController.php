<?php

declare(strict_types=1);

namespace App\Controller;

use App\DTO\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Util\DTOSerializer;

class PostController extends AbstractController
{
    #[Route(
        '/',
        name: 'blog_list',
        condition: "context.getMethod() in ['GET', 'HEAD']"
    )]
    public function list(DTOSerializer $serializer): Response
    {
        $data = '{
                    "userId": 1,
                    "id": 1,
                    "title": "sunt aut facere repellat provident occaecati excepturi optio reprehenderit",
                    "body": "quia et suscipit\nsuscipit recusandae consequuntur expedita et cum\nreprehenderit molestiae ut ut quas totam\nnostrum rerum est autem sunt rem eveniet architecto"
                  }';

        /** @var Post $posts */
        $posts = $serializer->deserialize($data, Post::class, 'json');

        return $this->render('posts/list.html.twig', ['posts' => $posts]);
    }

    #[Route(
        '/posts/{id}',
        name: 'post_show',
        condition: "params['id'] < 1000"
    )]
    public function showPost(int $id): Response
    {
        return $this->render(
            'base.html.twig',
            [
            ]
        );
    }
}