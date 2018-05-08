<?php

declare(strict_types=1);

namespace App\Report;

use App\Document\User;
use App\Notifier\UserNotifier;

class UserReporter
{
    /** @var ReportProvider */
    private $reportProvider;

    /** @var ReportPrinterFactory */
    private $printerFactory;

    /** @var UserNotifier */
    private $userNotifier;

    public function __construct(ReportProvider $reportProvider, ReportPrinterFactory $printerFactory, UserNotifier $userNotifier)
    {
        $this->reportProvider = $reportProvider;
        $this->printerFactory = $printerFactory;
        $this->userNotifier = $userNotifier;
    }

    public function report(User $user, string $type = ReportPrinterFactory::TYPE_EMAIL): void
    {
        $reportData = $this->reportProvider->getReport();
        $reportPrinter = $this->printerFactory->create($type);
        $printedReport = $reportPrinter->print($reportData);
        $this->userNotifier->send($user, $printedReport);
    }
}
