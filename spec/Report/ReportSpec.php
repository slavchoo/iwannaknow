<?php

namespace spec\App\Report;

use App\Report\Report;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReportSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Report::class);
    }

    function it_knows_how_to_add_new_item_to_collection()
    {
        $this->addItem(['num' => 1]);
        $this->getIterator()->shouldHaveCount(1);

        $this->addItem(['num' => 2]);
        $this->getIterator()->shouldHaveCount(2);

        $this->shouldIterateAs(new \ArrayIterator([['num' => 1], ['num' => 2]]));
    }
}
