<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/connect/github")
 */
class GithubController extends Controller
{
    /**
     * @Route("/", name="connect_github")
     */
    public function index(): Response
    {
        return $this->get('oauth2.registry')
            ->getClient('github')
            ->redirect();
    }

    /**
     * @Route("/check", name="connect_github_check")
     */
    public function connectGithub(Request $request): Response
    {
        return $this->redirectToRoute('home_page');
    }
}
