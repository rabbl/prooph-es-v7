<?php

declare(strict_types=1);

namespace AppBundle\Repository;

use AppBundle\Model\TodoAggregate;
use Prooph\EventSourcing\Aggregate\AggregateRepository;

class TodoList extends AggregateRepository
{
    /**
     * @param TodoAggregate $todo
     * @return void
     */
    public function save(TodoAggregate $todo)
    {
        $this->saveAggregateRoot($todo);
    }

    /**
     * @param TodoAggregate $todo
     * @return mixed
     */
    public function get(TodoAggregate $todo)
    {
        return $this->getAggregateRoot($todo->todoId()->toString());
    }
}
