<?php
use BuilderBox\Component\Console\Command\BuilderBoxAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    protected static $fixturesPath;

    protected static $application;

    public static function setUpBeforeClass()
    {
        static::$fixturesPath = __DIR__.'/../Fixtures/';
        require_once static::$fixturesPath.'/TestCommand.php';
        require_once static::$fixturesPath.'/TestCommandMessage.php';
        require_once static::$fixturesPath.'/TestCommandTable.php';
        require_once static::$fixturesPath.'/TestCommandProgress.php';
        require_once static::$fixturesPath.'/TestCommandRequiredServices.php';
        // require_once(__DIR__ . "/../../../../../../app/AppKernel.php");
        // $kernel = new \AppKernel("test", true);
        // $kernel->boot();
        // static::$application = new \Symfony\Bundle\FrameworkBundle\Console\Application($kernel);
    }

    public function testConstructor()
    {
        $command = new \TestCommand('namespace:name');
        $this->assertEquals('namespace:name', $command->getName());
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
        $tester = new CommandTester($command);
        $tester->execute(array(), array('interactive' => false, 'decorated' => false));
        $this->assertStringEqualsFile($files[0], $tester->getDisplay(true));
    }

    public function testStyleTable()
    {
        $files = $this->outputFilesProvider();
        $command = new \TestCommandTable();
        $tester = new CommandTester($command);
        $tester->execute(array(), array('interactive' => false, 'decorated' => false));
        $this->assertStringEqualsFile($files[1], $tester->getDisplay(true));
    }

    public function testStyleProgress()
    {
        $files = $this->outputFilesProvider();
        $command = new \TestCommandProgress();
        $tester = new CommandTester($command);
        $tester->execute(array(), array('interactive' => false, 'decorated' => false));
        $this->assertStringEqualsFile($files[2], $tester->getDisplay(true));
    }

    // public function testRequiredServices()
    // {
    //     $files = $this->outputFilesProvider();
    //     $command = new \TestCommandRequiredServices();
    //     $command->setApplication(static::$application);
    //     $tester = new CommandTester($command);
    //     $tester->execute(array(), array('interactive' => false, 'decorated' => false));
    //     $this->assertStringEqualsFile($files[3], $tester->getDisplay(true));
    // }

    public function outputFilesProvider()
    {
        return glob(sprintf("%s/%s", static::$fixturesPath, '/Style/output/output_*.txt'));
    }
}
