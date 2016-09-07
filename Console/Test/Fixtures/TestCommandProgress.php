<?php
use BuilderBox\Component\Console\Command\BuilderBoxAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommandProgress extends BuilderBoxAwareCommand
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
            ->progressStart(100)
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance(5)
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance(10)
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance(26)
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance(18)
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance(10)
            ->progressAdvance()
            ->progressAdvance()
            ->progressAdvance()
            ->progressFinish()
        ;
    }

    protected function getRequiredServices() {}
}
