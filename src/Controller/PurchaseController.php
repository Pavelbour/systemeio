<?php

namespace App\Controller;

use App\DTO\PurchaseRequestDto;
use App\Service\Purchase\PurchaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class PurchaseController extends AbstractController
{
    #[Route('/purchase', name: 'app_purchase', methods: ['POST'], format: 'json')]
    public function index(
        PurchaseService $service,
        #[MapRequestPayload(
            acceptFormat: 'json',
            validationFailedStatusCode: Response::HTTP_BAD_REQUEST
        )] PurchaseRequestDto $dto,
    ): JsonResponse
    {
        try {
            $service->processPayment($dto);
        } catch (\Exception $e) {
            return $this->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }

        return $this->json([
            'status' => 'success',
            'message' => 'Payment processed.',
        ]);
    }
}
