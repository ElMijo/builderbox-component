<?php
namespace BuilderBox\Component\Console\Command;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Base class for BuilderBox Command
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
abstract class BuilderBoxAwareCommand extends ContainerAwareCommand
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface|null
     */
    private $container;

    /**
     * @var \Symfony\Component\Console\Style\SymfonyStyle|null
     */
    protected $style;
    
    /**
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;
    
    /**
     * @var Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * It allows for an associative array with the services that you want
     * to instantiate the beginning of the command.
     * @return array|null associative array with the services that you want to instantiate Ej: ["manager" => "doctrine.orm.entity_manager"]
     */
    abstract protected function getRequiredServices();

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;
        $this->style = new SymfonyStyle($input, $output);

        try {
            $container = $this->getContainer();
            foreach($this->getRequiredServices() as $key => $value) {
                $this->{$key} = $container->get($value);
            }
        } catch (\Exception $e) {}
            
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::title()
     * @return self
     */
    final protected function title($text)
    {
        $this->style->title($text);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::section()
     * @return self
     */
    final protected function section($message)
    {
        $this->style->section($message);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::listing()
     * @return self
     */
    final protected function listing(array $elements)
    {
        $this->style->listing($elements);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::text()
     * @return self
     */
    final protected function text($message)
    {
        $this->multiline($message, 'text');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\SymfonyStyle::comment()
     * @return self
     */
    final protected function comment($message)
    {
        $this->multiline($message, 'comment');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::success()
     * @return self
     */
    final protected function success($message)
    {
        $this->multiline($message, 'success');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::error()
     * @return self
     */
    final protected function error($message)
    {
        $this->multiline($message, 'error');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::warning()
     * @return self
     */
    final protected function warning($message)
    {
        $this->block(
            $message,
            'WARNING',
            CommandStyle::styleBlock(
                CommandStyle::COLOR_BLACK,
                CommandStyle::COLOR_YELLOW
            ),
            ' ',
            true
        );
        return $this;
    }

    /**
     * Formats an info result bar.
     *
     * @param string|array $message
     * @return self
     */
    final protected function info($message)
    {
        $this->block(
            $message,
            'INFO',
            CommandStyle::styleBlock(
                CommandStyle::COLOR_BLACK,
                CommandStyle::COLOR_BLUE
            ),
            ' ',
            true
        );
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::note()
     * @return self
     */
    final protected function note($message)
    {
        $this->multiline($message, 'note');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::caution()
     * @return self
     */
    final protected function caution($message)
    {
        $this->multiline($message, 'caution');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::table()
     * @return self
     */
    final protected function table(array $headers, array $rows)
    {
        $this->style->table($headers, $rows);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::progressStart()
     * @return self
     */
    final protected function progressStart($max = 0)
    {
        $this->style->progressStart($max);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::progressAdvance()
     * @return self
     */
    final protected function progressAdvance($step = 1)
    {
        $this->style->progressAdvance($step);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::progressFinish()
     * @return self
     */
    final protected function progressFinish()
    {
        $this->style->progressFinish();
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::newLine()
     * @return self
     */
    final protected function newLine($count = 1)
    {
        $this->style->newLine($count);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\SymfonyStyle::block()
     * @return self
     */
    final protected function block($message, $type = null, $style = null, $prefix = ' ', $padding = false)
    {
        if (in_array(gettype($message), ['string', 'array'])) {
            $this->style->block($message, $type, $style, $prefix, $padding);
        }
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::ask()
     * @return string
     */
    final protected function ask($question, $default = null, $validator = null)
    {
        return $this->style->ask($question, $default, $validator);
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::askHidden()
     * @return string
     */
    final protected function askHidden($question, $validator = null)
    {
        return $this->style->askHidden($question, $validator);
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::choice()
     * @return string
     */
    final protected function choice($question, array $choices, $default = null)
    {
        return $this->style->choice($question, $choices, $default);
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::confirm()
     * @return boolean
     */
    final protected function confirm($question, $default = true)
    {
        return $this->style->confirm($question, $default);
    }

    // black, red, green, yellow, blue, magenta, cyan, white, default

    /**
     * It allows you to run the methods of this class that accept messages from multiple lines
     * @param  string|array $message
     * @param  string $method
     */
    private function multiline($message, $method)
    {
        if (in_array(gettype($message), ['string', 'array'])) {
            $this->style->{$method}($message);
        }
    }
}
