<?php

declare(strict_types=1);

namespace spec\App\Report\Printer;

use App\Report\Printer\EmailReportPrinter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmailReportPrinterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmailReportPrinter::class);
    }
}
