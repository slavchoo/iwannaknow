<?php

declare(strict_types=1);

namespace spec\App\GitHub\Repository;

use App\GitHub\Repository\IssueRepository;
use Github\Api\Search;
use Github\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IssueRepositorySpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IssueRepository::class);
    }

    function it_finds_pull_requests_by_username(Client $client, Search $searchApi)
    {
        $client->search()->shouldBeCalled()->willReturn($searchApi);
        $searchApi->issues(Argument::containingString('gh-username'))->willReturn(['items' => []]);

        $this->findOpenPRsByUsername('gh-username');
    }
}
