<?php

declare(strict_types=1);

namespace App\Report;

use App\Document\User;
use Github\Client;

class RepositoryProvider
{
    /** @var Client  */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function retrieve(User $user): array
    {
        $this->client->authenticate($user->getAccessToken(), null, Client::AUTH_HTTP_TOKEN);

        return $this->client->api('user')->myRepositories(['visibility' => 'all', 'per_page' => 1000]);
    }
}
