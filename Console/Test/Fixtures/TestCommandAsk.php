<?php
use BuilderBox\Component\Console\Command\BuilderBoxAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommandAsk extends BuilderBoxAwareCommand
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
        $ask = $this->ask("Do you like coffee?");
        // var_dump($ask);
        // $output->writeln('You ask: '.$ask);

    }
    
    protected function getRequiredServices() {}
    
    public function getInputInterface()
    {
        return $this->input;
    }
    
    public function getOutputInterface()
    {
        return $this->output;
    }
    
    public function setStyle($style)
    {
        $this->style = $style;
    }
    
    public function getStyle()
    {
        return $this->style;
    }
}
