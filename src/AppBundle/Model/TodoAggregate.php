<?php

declare(strict_types=1);

namespace AppBundle\Model;

use AppBundle\Model\Event\TodoWasCreated;
use Prooph\EventSourcing\AggregateChanged;
use Prooph\EventSourcing\AggregateRoot;

class TodoAggregate extends AggregateRoot
{
    /** @var  TodoId */
    private $todoId;

    /** @var  UserId */
    private $userId;

    public static function create(UserId $userId, TodoId $todoId): TodoAggregate
    {
        $self = new self();
        $self->todoId = $todoId;
        $self->userId = $userId;
        $self->recordThat(TodoWasCreated::byUser($userId, $todoId));
        return $self;
    }

    public function todoId()
    {
        return $this->todoId;
    }

    protected function whenModflowModelWasCreated(TodoWasCreated $event): void
    {
        $this->todoId = $event->todoId();
        $this->userId = $event->userId();
    }

    protected function aggregateId(): string
    {
        return $this->todoId->toString();
    }

    protected function apply(AggregateChanged $e): void
    {
        // TODO: Implement apply() method.
    }
}
