<?php
use BuilderBox\Component\Console\Command\BuilderBoxAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommandMessage extends BuilderBoxAwareCommand
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
        $ref = new \ReflectionProperty(get_class($this->style), 'lineLength');
        $ref->setAccessible(true);
        $ref->setValue($this->style, 120);
        $this
            ->title('Title')
            ->section('Section')
            ->listing(['Elemento 1', 'Elemento 2'])
            ->text('Texto simple')
            ->text(['Texto 1', 'Texto 2'])
            ->comment('comment simple')
            ->comment(['comment 1', 'comment 2'])
            ->success('success simple')
            ->success(['success 1', 'success 2'])
            ->error('error simple')
            ->error(['error 1', 'error 2'])
            ->warning('warning simple')
            ->warning(['warning 1', 'warning 2'])
            ->info('info simple')
            ->info(['info 1', 'info 2'])
            ->note('note simple')
            ->note(['note 1', 'note 2'])
            ->caution('caution simple')
            ->caution(['caution 1', 'caution 2'])
            ->block('Block', 'BLOCK', 'fg=black;bg=cyan', ' ', true)
        ;
    }

    protected function getRequiredServices() {}
}
