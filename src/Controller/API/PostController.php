<?php

declare(strict_types=1);

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/API')]
class PostController extends AbstractController
{
    #[Route(
        '/',
        name: 'api_blog_list',
        methods: 'GET'
    )]
    public function list(): JsonResponse
    {
        return new JsonResponse(data: 'ok', status: Response::HTTP_OK, json: true);

    }
}