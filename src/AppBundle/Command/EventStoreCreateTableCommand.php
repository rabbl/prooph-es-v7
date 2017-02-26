<?php

namespace AppBundle\Command;

use Prooph\EventStore\StreamName;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class EventStoreCreateTableCommand extends ContainerAwareCommand
{
    protected function configure(): void
    {
        // Name and description for app/console command
        $this
            ->setName('prooph:eventstore:create')
            ->setDescription('Creates the eventstore table.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $connection = $this->getContainer()->get('event_store_pdo');
        $strategy = $this->getContainer()->get('prooph_event_store.mysql.aggregate_stream_strategy');
        $schema = $strategy->createSchema(new StreamName('event_stream_test'));
        foreach ($schema as $command) {
            $statement = $connection->prepare($command);
            $statement->execute();
        }
    }
}
