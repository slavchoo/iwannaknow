<?php

declare(strict_types=1);

namespace App\Tests\Command;

use App\Document\User;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use App\Command\ReportsGenerateCommand;
use Symfony\Component\Console\Tester\CommandTester;

class ReportsGenerateCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $managerRegistry = $this->prophesize(ManagerRegistry::class);
        $userRepository = $this->prophesize(DocumentRepository::class);

        $user = $this->prophesize(User::class);
        $user->getId()->shouldBeCalled()->willReturn(777);
        $userRepository->findAll()->shouldBeCalled()->willReturn([$user]);
        $userRepository->find()->shouldNotBeCalled();

        $managerRegistry->getRepository(User::class)->shouldBeCalled()->willReturn($userRepository->reveal());

        $application->add(new ReportsGenerateCommand($managerRegistry->reveal()));

        $command = $application->find('app:reports:generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
        ]);

//         the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Generating report for user user_id=777', $output);
    }

    public function testExecuteUserIdOptionPassed()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $managerRegistry = $this->prophesize(ManagerRegistry::class);
        $userRepository = $this->prophesize(DocumentRepository::class);

        $user = $this->prophesize(User::class);
        $user->getId()->shouldBeCalled()->willReturn(777);
        $userRepository->findAll()->shouldNotBeCalled()->willReturn([$user]);
        $userRepository->find(777)->shouldBeCalled()->willReturn($user);

        $managerRegistry->getRepository(User::class)->shouldBeCalled()->willReturn($userRepository->reveal());

        $application->add(new ReportsGenerateCommand($managerRegistry->reveal()));

        $command = $application->find('app:reports:generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command'  => $command->getName(),
            '--user_id' => 777,
        ]);

//         the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('Generating report for user user_id=777', $output);
    }
}
