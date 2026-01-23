<?php

namespace App\Exception;

class AlreadyExistsException extends \RuntimeException
{
    public function __construct(private readonly string $entity = 'Entity')
    {
        parent::__construct($this->entity . ' already exists', 409);
    }

    public function getEntity(): string
    {
        return $this->entity;
    }
}
