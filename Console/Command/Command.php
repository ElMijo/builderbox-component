<?php
namespace BuilderBox\Component\Console\Command;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Base class for BuilderBox Command
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class Command extends SymfonyCommand implements ContainerAwareInterface
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
     * @var \Doctrine\ORM\EntityManager
     */
    protected $manager;

    /**
     * @var \Symfony\Component\Console\Helper\QuestionHelper
     */
    protected $helper;

    public function __construct($name = null)
    {
        parent::__construct($name);
    }

    /**
     * @return ContainerInterface
     *
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    protected function getContainer()
    {
        if (null === $this->container) {
            $application = $this->getApplication();
            if (null === $application) {
                throw new LogicException('The container cannot be retrieved as the application instance is not yet set.');
            }
            $this->container = $application->getKernel()->getContainer();
        }

        return $this->container;
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        // $this->manager = $this->getContainer()->get('doctrine.orm.entity_manager');
        $this->style = new SymfonyStyle($input, $output);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::title()
     * @return self
     */
    protected function title($text)
    {
        $this->style->title($text);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::section()
     * @return self
     */
    protected function section($message)
    {
        $this->style->section($message);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::listing()
     * @return self
     */
    protected function listing(array $elements)
    {
        $this->style->listing($elements);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::text()
     * @return self
     */
    protected function text($message)
    {
        $this->multiline($message, 'text');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\SymfonyStyle::comment()
     * @return self
     */
    protected function comment($message)
    {
        $this->multiline($message, 'comment');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::success()
     * @return self
     */
    protected function success($message)
    {
        $this->multiline($message, 'success');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::error()
     * @return self
     */
    protected function error($message)
    {
        $this->multiline($message, 'error');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::warning()
     * @return self
     */
    protected function warning($message)
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
    protected function info($message)
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
    protected function note($message)
    {
        $this->multiline($message, 'note');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::caution()
     * @return self
     */
    protected function caution($message)
    {
        $this->multiline($message, 'caution');
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::table()
     * @return self
     */
    protected function table(array $headers, array $rows)
    {
        $this->style->table($headers, $rows);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::progressStart()
     * @return self
     */
    protected function progressStart($max = 0)
    {
        $this->style->progressStart($max);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::progressAdvance()
     * @return self
     */
    protected function progressAdvance($step = 1)
    {
        $this->style->progressAdvance($step);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::progressFinish()
     * @return self
     */
    protected function progressFinish()
    {
        $this->style->progressFinish();
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::newLine()
     * @return self
     */
    protected function newLine($count = 1)
    {
        $this->style->newLine($count);
        return $this;
    }

    /**
     * @see \Symfony\Component\Console\Style\SymfonyStyle::block()
     * @return self
     */
    protected function block($message, $type = null, $style = null, $prefix = ' ', $padding = false)
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
    public function ask($question, $default = null, $validator = null)
    {
        return $this->style->ask($question, $default, $validator);
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::askHidden()
     * @return string
     */
    public function askHidden($question, $validator = null)
    {
        return $this->style->askHidden($question, $validator);
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::choice()
     * @return string
     */
    public function choice($question, array $choices, $default = null)
    {
        return $this->style->choice($question, $choices, $default);
    }

    /**
     * @see \Symfony\Component\Console\Style\StyleInterface::confirm()
     * @return boolean
     */
    public function confirm($question, $default = true)
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
