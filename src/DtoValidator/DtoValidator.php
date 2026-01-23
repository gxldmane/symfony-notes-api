<?php

namespace App\DtoValidator;

use App\Dto\BaseDto;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoValidator
{
    public function __construct(
        private ValidatorInterface $validator,
    ){}

    public function validate(BaseDto $dto): void {
        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getPropertyPath() . ': ' . $error->getMessage();
            }
            throw new \InvalidArgumentException(implode("\n", $errorMessages));
        }
    }

}
