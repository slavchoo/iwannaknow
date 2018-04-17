<?php

declare(strict_types=1);

namespace App\Controller;

use App\Report\ReportProvider;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use DateTime;

class DashboardController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/home", name="home_page")
     * @Template()
     */
    public function index(ReportProvider $reporter): array
    {
        $reporter->setUser($this->getUser());

        $report = $reporter->getPullRequestsToReview();

        return [
            'report' => $report,
            'reportDate' => new DateTime(),
        ];
    }
}
