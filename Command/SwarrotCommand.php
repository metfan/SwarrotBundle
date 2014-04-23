<?php

namespace Swarrot\SwarrotBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Swarrot\SwarrotBundle\Broker\FactoryInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

/**
 * SwarrotCommand.
 *
 * @author Olivier Dolbeau <contact@odolbeau.fr>
 */
class SwarrotCommand extends ContainerAwareCommand
{
    protected $factory;
    protected $name;
    protected $processorId;
    protected $connectionName;

    public function __construct(FactoryInterface $factory, $name, $processorId, $connectionName)
    {
        $this->factory        = $factory;
        $this->name           = $name;
        $this->processorId    = $processorId;
        $this->connectionName = $connectionName;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('swarrot:consume:'.$this->name)
            ->setDescription(sprintf('Consume message of type "%s" from a given queue', $this->name))
            ->addArgument('queue', InputArgument::REQUIRED, 'Queue to consume')
            ->addArgument('connection', InputArgument::OPTIONAL, 'Connection to use', $this->connectionName)
            ->addOption('max-execution-time', 't', InputOption::VALUE_REQUIRED, 'Max execution time (seconds) before exit', 300)
            ->addOption('max-messages', 'm', InputOption::VALUE_REQUIRED, 'Max messages to process before exit', 300)
            ->addOption('requeue-on-error', 'r', InputOption::VALUE_NONE, 'Requeue in the same queue on error')
            ->addOption('no-catch', 'C', InputOption::VALUE_NONE, 'Deactivate exception catching.')
            ->addOption('poll-interval', null, InputOption::VALUE_REQUIRED, 'Poll interval (in micro-seconds)', 500000)
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //$messageProvider = $this->factory->getMessageProvider();
    }
}
