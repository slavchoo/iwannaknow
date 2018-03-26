<?php

namespace spec\App\Report;

use App\Report\ReportRetriever;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReportRetrieverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ReportRetriever::class);
    }
}
