<?php

declare(strict_types=1);

namespace App\Report;

use App\Document\User;
use Github\Api\Search;
use Github\Client;

class ReportProvider
{
    /** @var Client */
    private $client;

    /** @var User */
    private $user;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getPullRequestsToReview(): iterable
    {
        $this->client->authenticate($this->user->getAccessToken(), null, Client::AUTH_HTTP_TOKEN);

        return $this->getSearchApi()->issues(sprintf('review-requested:%s is:open', $this->user->getUsername()));
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    private function getSearchApi(): Search
    {
        return $this->client->search();
    }
}
