<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\AlreadyExistsException;
use App\Factory\UserFactory;
use App\Repository\UserRepository;
use App\Dto\User\UserRegisterDto;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepo,
        private readonly UserFactory $userFactory,
    )
    {
    }

    public function create(UserRegisterDto $dto): User
    {
        if ($this->userRepo->findOneByEmail($dto->email)) {
            throw new AlreadyExistsException('User');
        }
        $user = $this->userFactory->createFromDto($dto);
        return $this->userRepo->save($user);
    }
}
