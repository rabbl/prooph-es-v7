<?php

namespace tests\AppBundle\Functional;

use AppBundle\Model\Event\TodoWasCreated;
use AppBundle\Model\TodoId;
use AppBundle\Model\UserId;
use Prooph\EventStore\EventStore;
use Prooph\EventStore\StreamName;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EventStoreTest extends KernelTestCase
{

    /** @var EventStore */
    private $eventStore;

    public function setUp(){
        self::bootKernel();

        $this->eventStore = static::$kernel->getContainer()
            ->get('prooph_event_store.main_store');
    }

    /**
     * @test
     */
    public function it_returns_true()
    {
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function it_appends_an_event_to_stream()
    {
        $userId = UserId::generate();
        $todoId = TodoId::generate();
        $this->eventStore->appendTo(new StreamName('event_stream_test'), new \ArrayIterator([TodoWasCreated::byUser($userId, $todoId)]));
    }

}