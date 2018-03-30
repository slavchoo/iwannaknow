<?php

declare(strict_types=1);

namespace App\Controller;

use App\Report\RepositoryProvider;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index_page")
     */
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/home", name="home_page")
     */
    public function home(RepositoryProvider $repositoryProvider): Response
    {
        $repositories = $repositoryProvider->retrieve($this->getUser());

        return $this->render('default/home.html.twig', [
            'repositories' => $repositories,
        ]);
    }
}
