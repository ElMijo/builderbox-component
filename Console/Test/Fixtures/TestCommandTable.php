<?php
use BuilderBox\Component\Console\Command\BuilderBoxAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommandTable extends BuilderBoxAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('namespace:name')
            ->setAliases(array('name'))
            ->setDescription('description')
            ->setHelp('help')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this
            ->table(['header 1', 'header 2'], [['row 1.1', 'row 1.2'], ['row 2.1', 'row 2.2']])
            ->table([], [['row 1.1', 'row 1.2'], ['row 2.1', 'row 2.2']])
            ->table(['header 1', 'header 2'], [])
        ;
    }

    protected function getRequiredServices() {}
}
