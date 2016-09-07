<?php
use BuilderBox\Component\Console\Command\BuilderBoxAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommandRequiredServices extends BuilderBoxAwareCommand
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $manager;

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
        $output->writeln(get_class($this->manager));
        $output->writeln(get_class($this->translator));
        $output->writeln(get_class($this->router));
    }

    protected function getRequiredServices() {
        return array(
            'manager' => 'doctrine.orm.entity_manager',
            'translator' => 'translator',
            'router' => 'router'
        );
    }
}
