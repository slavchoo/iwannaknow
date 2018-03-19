<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    /**
     * @Route("/connect/github", name="connect_github")
     */
    public function index()
    {
        return $this->get('oauth2.registry')
            ->getClient('github')
            ->redirect();
    }
}
