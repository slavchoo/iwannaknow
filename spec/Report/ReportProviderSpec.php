<?php

declare(strict_types=1);

namespace spec\App\Report;

use App\Document\User;
use App\Report\Report;
use App\Report\ReportProvider;
use Github\Api\Search;
use Github\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReportProviderSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ReportProvider::class);
    }

    function it_returns_code_review_request(User $user, Client $client, Search $searchApi)
    {
        $user->getAccessToken()->willReturn('gh_token');
        $client->authenticate('gh_token', null, Client::AUTH_HTTP_TOKEN)->shouldBeCalled();

        $client->search()->shouldBeCalled()->willReturn($searchApi);
        $searchApi->issues(Argument::type('string'))->willReturn(['items' => []]);

        $user->getUsername()->shouldBeCalled();

        $this->setUser($user);
        $this->getPullRequestsToReview()->shouldReturnAnInstanceOf(Report::class);
    }
}
