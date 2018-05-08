<?php

declare(strict_types=1);

namespace spec\App\Report;

use App\Document\User;
use App\Notifier\UserNotifier;
use App\Report\Printer\ReportPrinterInterface;
use App\Report\ReportPrinterFactory;
use App\Report\ReportProvider;
use App\Report\UserReporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserReporterSpec extends ObjectBehavior
{
    function let(ReportProvider $reportProvider, ReportPrinterFactory $printerFactory, UserNotifier $userNotifier)
    {
        $this->beConstructedWith($reportProvider, $printerFactory, $userNotifier);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UserReporter::class);
    }

    function it_sends_report_to_user(
        User $user,
        ReportProvider $reportProvider,
        ReportPrinterFactory $printerFactory,
        ReportPrinterInterface $reportPrinter,
        UserNotifier $userNotifier
    ) {
        $reportProvider->getReport()->shouldBeCalled()->willReturn([]);
        $printerFactory->create(ReportPrinterFactory::TYPE_EMAIL)->shouldBeCalled()->willReturn($reportPrinter);
        $reportPrinter->print([])->shouldBeCalled()->willReturn('rendered report');
        $userNotifier->send($user, 'rendered report')->shouldBeCalled();

        $this->report($user);
    }
}
