<?php

declare(strict_types=1);

namespace App\GitHub\Repository;

use Github\Api\Search;
use Github\Client;

class IssueRepository implements AuthAwareInterface
{
    /** @var Client */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function findOpenPRsByUsername(string $username): iterable
    {
        return $this->getSearchApi()->issues(sprintf('review-requested:%s is:open', $username));
    }

    private function getSearchApi(): Search
    {
        return $this->client->search();
    }

    public function authinteficate($token)
    {
        $this->client->authenticate($token, null, Client::AUTH_HTTP_TOKEN);
    }
}
