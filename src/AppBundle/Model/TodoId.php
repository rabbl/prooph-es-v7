<?php

declare(strict_types=1);

namespace AppBundle\Model;

use Ramsey\Uuid\Uuid;

class TodoId
{
    /** @var  Uuid $id */
    private $id;

    public static function fromString(string $id): TodoId
    {
        if (! Uuid::isValid($id)){
            throw new \Exception(sprintf('Uuid-String %s is not valid.', $id));
        }

        $self = new self();
        $self->id = Uuid::fromString($id);
        return $self;
    }

    public static function generate(): TodoId
    {
        $self = new self();
        $self->id = Uuid::uuid4();
        return $self;
    }

    public function toString(): string
    {
        return $this->id->toString();
    }

    private function __construct(){}
}
