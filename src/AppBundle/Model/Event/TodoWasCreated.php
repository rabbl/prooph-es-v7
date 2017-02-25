<?php

namespace AppBundle\Model\Event;

use AppBundle\Model\TodoId;
use AppBundle\Model\UserId;
use Prooph\EventSourcing\AggregateChanged;

class TodoWasCreated extends AggregateChanged
{
    /** @var  TodoId */
    private $todoId;

    /** @var  UserId */
    private $userId;

    public static function byUser(UserId $userId, TodoId $todoId): TodoWasCreated
    {
        $event = self::occur($todoId->toString(),[
            'user_id' => $userId->toString()
        ]);

        $event->todoId = $todoId;
        $event->userId = $userId;
        return $event;
    }

    public function todoId(): TodoId
    {
        if ($this->todoId === null){
            $this->todoId = TodoId::fromString($this->aggregateId());
        }

        return $this->todoId;
    }

    public function userId(): UserId{
        if ($this->userId === null){
            $this->userId = UserId::fromString($this->payload['user_id']);
        }

        return $this->userId;
    }
}
