<?php

namespace spec\App\Report;

use App\Document\User;
use App\Report\ReportRetriever;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReportRetrieverSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ReportRetriever::class);
    }

    function it_is_rerieve_report_by_user(User $user)
    {
        $this->retrieve($user);
    }
}
