<?php
use BuilderBox\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    protected static $fixturesPath;

    public static function setUpBeforeClass()
    {
        self::$fixturesPath = __DIR__.'/../Fixtures/';
        require_once self::$fixturesPath.'/TestCommand.php';
        require_once self::$fixturesPath.'/TestCommandMessage.php';
    }

    public function testConstructor()
    {
        $command = new Command('namespace:name');
        $this->assertEquals('namespace:name', $command->getName());
    }

    /**
     * @expectedException        \LogicException
     */
    public function testCommandEmptyName()
    {
        new Command();
    }

    public function testSetApplication()
    {
        $application = new Application();
        $command = new \TestCommand();
        $command->setApplication($application);
        $this->assertEquals($application, $command->getApplication());
    }

    public function testStyleMessage()
    {
        $files = $this->outputFilesProvider();
        $command = new \TestCommandMessage();
        // $command->setApplication(new Application());
        $tester = new CommandTester($command);
        $tester->execute(array(), array('interactive' => false, 'decorated' => false));
        $this->assertStringEqualsFile($files[0], $tester->getDisplay(true));
        // print_r($tester->getDisplay(true));
    }

    public function outputFilesProvider()
    {
        return glob(sprintf("%s/%s", self::$fixturesPath, '/Style/output/output_*.txt'));
    }

    // public function testOutputs($inputCommandFilepath, $outputFilepath)
    // {
    //     $code = require $inputCommandFilepath;
    //     $this->command->setCode($code);
    //     $this->tester->execute(array(), array('interactive' => false, 'decorated' => false));
    //     $this->assertStringEqualsFile($outputFilepath, $this->tester->getDisplay(true));
    // }
}
