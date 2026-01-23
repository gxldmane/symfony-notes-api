<?php

namespace App\Resource;

use App\Dto\User\UserOutputDto;
use Symfony\Component\Serializer\SerializerInterface;

class UserResource
{
    public function __construct(
        private readonly SerializerInterface $serializer,
    )
    {
    }

    public function asItem(UserOutputDto $dto): string
    {
        return $this->serializer->serialize($dto, 'json', ['groups' => ['user:item']]);
    }
}
