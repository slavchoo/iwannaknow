<?php

namespace spec\App\Report;

use App\Document\User;
use App\Report\RepositoryProvider;
use Github\Client;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RepositoryProviderSpec extends ObjectBehavior
{
    function let(Client $client)
    {
        $this->beConstructedWith($client);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RepositoryProvider::class);
    }

    function it_is_rerieve_report_by_user(User $user, Client $client, \Github\Api\User $userApi)
    {
        $user->getAccessToken()->willReturn('gh_token');
        $client->authenticate('gh_token', null, Client::AUTH_HTTP_TOKEN)->shouldBeCalled();
        $client->api('user')->shouldBeCalled()->willReturn($userApi);
        $userApi->myRepositories(['visibility' => 'all', 'per_page' => 1000])->shouldBeCalled()->willReturn([]);

        $this->retrieve($user);
    }
}
