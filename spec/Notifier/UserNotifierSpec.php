<?php

namespace spec\App\Notifier;

use App\Notifier\UserNotifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserNotifierSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(UserNotifier::class);
    }

    function it_sends_report_to_user()
    {
        $this->send();
    }
}
