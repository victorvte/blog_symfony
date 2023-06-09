<?php

declare(strict_types=1);

namespace App\Controller\API;

use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/check', name: 'health_check', methods: ['GET'])]
#[OA\Response(
    response: 200,
    description: 'Check the API'
)]
#[OA\Tag(name: 'Health Check')]
class HealthCheck
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse('ok');
    }
}
