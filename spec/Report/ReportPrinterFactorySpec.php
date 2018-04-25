<?php

declare(strict_types=1);

namespace spec\App\Report;

use App\Report\Printer\EmailReportPrinter;
use App\Report\ReportPrinterFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReportPrinterFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ReportPrinterFactory::class);
    }

    function it_created_report_printers()
    {
        $this->create(ReportPrinterFactory::TYPE_EMAIL)->shouldBeAnInstanceOf(EmailReportPrinter::class);
    }
}
