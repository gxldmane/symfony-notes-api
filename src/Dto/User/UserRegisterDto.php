<?php

namespace App\Dto\User;

use App\Dto\BaseDto;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterDto extends BaseDto
{
    #[Assert\NotBlank(message: 'This value is not a valid email address.', allowNull: null, normalizer: 'trim')]
    #[Assert\Email(message: 'This value is not a valid email address.')]
    public ?string $email = null;

    #[Assert\NotBlank(message: 'Password need to be not blank.', allowNull: null, normalizer: 'trim')]
    #[Assert\Length(min: 6, max: 255, minMessage: 'Password must be at least 6 characters long', maxMessage: 'Password cannot be longer than 255 characters')]
    public ?string $password = null;
}
