<?php

namespace App\Response;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Resource\UserResource;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserResponseBuilder
{
    public function __construct(
        private readonly UserFactory              $userFactory,
        private readonly UserResource             $userResource,
        private readonly JWTTokenManagerInterface $jwt,
    )
    {
    }

    public function registerResponse(User $user, int $status): JsonResponse
    {
        $outputDto = $this->userFactory->makeUserOutputDto($user);
        $userResource = json_decode($this->userResource->asItem($outputDto));

        return new JsonResponse([
            'user' => $userResource,
            'token' => $this->jwt->create($user)
        ], status: $status);
    }
}
