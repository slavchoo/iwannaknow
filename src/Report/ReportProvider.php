<?php

declare(strict_types=1);

namespace App\Report;

use App\Document\User;
use App\GitHub\Repository\IssueRepository;

class ReportProvider
{
    /** @var User */
    private $user;

    /**
     * @var IssueRepository
     */
    private $issueRepository;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
    }

    public function getPullRequestsToReview(): Report
    {
        $this->issueRepository->authinteficate($this->user->getAccessToken());
        $items = $this->issueRepository->findOpenPRsByUsername($this->user->getUsername());

        return $this->convertResponse($items);
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
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
