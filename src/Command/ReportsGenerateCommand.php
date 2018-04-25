<?php

declare(strict_types=1);

namespace App\Command;

use App\Document\User;
use App\Report\ReportProvider;
use App\Report\UserReporter;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\StyleInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ReportsGenerateCommand extends Command
{
    protected static $defaultName = 'app:reports:generate';

    private $managerRegistry;
    private $userReporter;

    public function __construct(ManagerRegistry $managerRegistry, UserReporter $userReporter)
    {
        $this->managerRegistry = $managerRegistry;
        $this->userReporter = $userReporter;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Generate reports for users')
            ->addOption('user_id', 'uid', InputOption::VALUE_OPTIONAL, 'Single user ID to generate report')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        if ($userId = $input->getOption('user_id')) {
            $user = $this->getUserRepository()->find($userId);
            $this->generateReportByUser($io, $user);
        } else {
            $users = $this->getUserRepository()->findAll();

            foreach ($users as $user) {
                $this->generateReportByUser($io, $user);
            }
        }

        $io->success('Done!');
    }

    private function generateReportByUser(StyleInterface $io, User $user): void
    {
        $io->text(sprintf('Generating report for user user_id=%d', $user->getId()));
        $this->userReporter->report($user);
    }

    private function getUserRepository(): DocumentRepository
    {
        return $this->managerRegistry->getRepository(User::class);
    }
}
