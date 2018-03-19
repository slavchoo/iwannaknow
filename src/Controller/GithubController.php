<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/github")
 */
class GithubController extends Controller
{
    /**
     * @Route("/check", name="connect_github_check")
     */
    public function index(Request $request)
    {
        $code = $request->query->get('code');
        $state = $request->query->get('state');

        return new Response();
    }
}
