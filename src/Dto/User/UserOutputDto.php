<?php

namespace App\Dto\User;

use App\Dto\BaseDto;
use Symfony\Component\Serializer\Attribute\Groups;

class UserOutputDto extends BaseDto
{
    #[Groups(groups: ['user:item'])]
    public ?string $email = null;

    #[Groups(groups: ['user:item'])]
    public ?string $password = null;
}
