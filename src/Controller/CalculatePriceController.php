<?php

namespace App\Controller;

use App\DTO\CalculatePriceRequestDto;
use App\Service\PriceCalculator\PriceCalculatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class CalculatePriceController extends AbstractController
{
    #[Route('/calculate-price', name: 'app_calculate_price', methods: ['POST'], format: 'json')]
    public function index(
        PriceCalculatorService $service,
        #[MapRequestPayload(
            acceptFormat: 'json',
            validationFailedStatusCode: Response::HTTP_BAD_REQUEST
        )] CalculatePriceRequestDto $dto,
    ): JsonResponse
    {
        try{
            $price = $service->calculateProductPrice($dto);
        } catch(\Exception $e) {
            $message = $e->getMessage();
            $errors = json_validate($message) ? json_decode($message) : $message;

            return $this->json([
                'status' => 'error',
                "messages" => $errors,
            ], 400);
        }

        return $this->json([
            'status' => 'success',
            'price' => $price,
        ]);
    }
}
