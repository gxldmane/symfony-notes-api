<?php

namespace App\Factory;

use App\Dto\User\UserOutputDto;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Dto\User\UserRegisterDto;

class UserFactory
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
    )
    {
    }

    public function createFromDto(UserRegisterDto $dto): User
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword($this->hasher->hashPassword($user, $dto->password));
        return $user;
    }

    public function makeUserRegisterDto(array $data): UserRegisterDto
    {
        $dto = new UserRegisterDto();
        $dto->email = $data['email'] ?? null;
        $dto->password = $data['password'] ?? null;
        return $dto;
    }

    public function makeUserOutputDto(User $user): UserOutputDto
    {
        $dto = new UserOutputDto();
        $dto->email = $user->getEmail();
        $dto->password = $user->getPassword();
        return $dto;
    }
}
