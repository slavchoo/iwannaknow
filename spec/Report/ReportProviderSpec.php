<?php

declare(strict_types=1);

namespace spec\App\Report;

use App\Document\User;
use App\GitHub\Repository\IssueRepository;
use App\Report\Report;
use App\Report\ReportProvider;
use PhpSpec\ObjectBehavior;

class ReportProviderSpec extends ObjectBehavior
{
    function let(IssueRepository $issueRepository)
    {
        $this->beConstructedWith($issueRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ReportProvider::class);
    }

    function it_returns_code_review_request(User $user, IssueRepository $issueRepository)
    {
        $user->getAccessToken()->shouldBeCalled()->willReturn('gh_token');
        $user->getUsername()->shouldBeCalled()->willReturn('gh-username');
        $issueRepository->authinteficate('gh_token')->shouldBeCalled();
        $issueRepository->findOpenPRsByUsername('gh-username')->shouldBeCalled()->willReturn(['items' => []]);

        $this->setUser($user);
        $this->getPullRequestsToReview()->shouldReturnAnInstanceOf(Report::class);
    }
}
