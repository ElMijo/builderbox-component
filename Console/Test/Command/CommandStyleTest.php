<?php
namespace BuilderBox\Component\Console\Test\Command;

use PHPUnit_Framework_TestCase;
use BuilderBox\Component\Console\Command\CommandStyle;

class CommandStyleTest extends PHPUnit_Framework_TestCase
{
    public function testColor()
    {
        $this->assertEquals(CommandStyle::COLOR_BLACK, 'black');
        $this->assertEquals(CommandStyle::COLOR_RED, 'red');
        $this->assertEquals(CommandStyle::COLOR_GREEN, 'green');
        $this->assertEquals(CommandStyle::COLOR_YELLOW, 'yellow');
        $this->assertEquals(CommandStyle::COLOR_BLUE, 'blue');
        $this->assertEquals(CommandStyle::COLOR_MAGENTA, 'magenta');
        $this->assertEquals(CommandStyle::COLOR_CYAN, 'cyan');
        $this->assertEquals(CommandStyle::COLOR_WHITE, 'white');
        $this->assertEquals(CommandStyle::COLOR_DEFAULT, 'default');
    }

    public function testStyleBlock()
    {

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_BLACK,
            CommandStyle::COLOR_BLACK
        );
        $this->assertEquals($styleBlock, 'fg=black;bg=black');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_RED,
            CommandStyle::COLOR_RED
        );
        $this->assertEquals($styleBlock, 'fg=red;bg=red');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_GREEN,
            CommandStyle::COLOR_GREEN
        );
        $this->assertEquals($styleBlock, 'fg=green;bg=green');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_BLUE,
            CommandStyle::COLOR_BLUE
        );
        $this->assertEquals($styleBlock, 'fg=blue;bg=blue');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_YELLOW,
            CommandStyle::COLOR_YELLOW
        );
        $this->assertEquals($styleBlock, 'fg=yellow;bg=yellow');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_MAGENTA,
            CommandStyle::COLOR_MAGENTA
        );
        $this->assertEquals($styleBlock, 'fg=magenta;bg=magenta');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_CYAN,
            CommandStyle::COLOR_CYAN
        );
        $this->assertEquals($styleBlock, 'fg=cyan;bg=cyan');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_WHITE,
            CommandStyle::COLOR_WHITE
        );
        $this->assertEquals($styleBlock, 'fg=white;bg=white');

        $styleBlock = CommandStyle::styleBlock(
            CommandStyle::COLOR_DEFAULT,
            CommandStyle::COLOR_DEFAULT
        );
        $this->assertEquals($styleBlock, 'fg=default;bg=default');
    }
    /**
     * @expectedException \BuilderBox\Component\Console\Exception\CommandStyleNotFoundException
     */
    public function testFailStyleBlockOne()
    {
        $styleBlock = CommandStyle::styleBlock('black', 'not-color');
    }

    /**
     * @expectedException \BuilderBox\Component\Console\Exception\CommandStyleNotFoundException
     */
    public function testFailStyleBlockTwo()
    {
        $styleBlock = CommandStyle::styleBlock('not-color', 'red');
    }

    /**
     * @expectedException \BuilderBox\Component\Console\Exception\CommandStyleNotFoundException
     */
    public function testFailStyleBlockThree()
    {
        $styleBlock = CommandStyle::styleBlock(true, false);
    }

    /**
     * @expectedException \BuilderBox\Component\Console\Exception\CommandStyleNotFoundException
     */
    public function testFailStyleBlockFour()
    {
        $styleBlock = CommandStyle::styleBlock(0, 1);
    }
}
