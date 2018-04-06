<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    /**
     * Temp test to check auth system
     */
    public function testIndexAction()
    {
        $client = static::createClient();
        $client->request('GET', '/home');

        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }
}
