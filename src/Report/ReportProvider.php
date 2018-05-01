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

    public function getPullRequestsToReview(): Report
    {
        $this->client->authenticate($this->user->getAccessToken(), null, Client::AUTH_HTTP_TOKEN);

        $items = $this->getSearchApi()->issues(sprintf('review-requested:%s is:open', $this->user->getUsername()));

        return $this->convertResponse($items);
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    private function getSearchApi(): Search
    {
        return $this->client->search();
    }

    private function convertResponse(iterable $response): Report
    {
        $report = new Report();

        foreach ($response['items'] as $item) {
            $report->addItem($item);
        }

        return $report;
    }
}
