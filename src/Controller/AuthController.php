<?php

declare(strict_types=1);

namespace App\Controller;

use App\DtoValidator\DtoValidator;
use App\Factory\UserFactory;
use App\Response\UserResponseBuilder;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    public function __construct(
        private readonly UserFactory         $userFactory,
        private readonly UserService         $userService,
        private readonly DtoValidator        $dtoValidator,
        private readonly UserResponseBuilder $userResponse,
        private readonly Security            $security,
    )
    {
    }

    #[Route('/api/auth/register', name: 'auth_register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $dto = $this->userFactory->makeUserRegisterDto($data);
        $this->dtoValidator->validate($dto);
        $user = $this->userService->create($dto);
        return $this->userResponse->registerResponse($user, Response::HTTP_CREATED);
    }

    #[Route('/api/auth/me', name: 'auth_me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        $user = $this->security->getUser();
        return $this->userResponse->meResponse($user, Response::HTTP_OK);
    }
}
