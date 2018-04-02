<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('a:contains("Connect with")')->count());
    }

    /**
     * Temp test to check auth system
     */
    public function testIndexHomeAction()
    {
        $client = static::createClient();
        $client->request('GET', '/home');

        $this->assertSame(302, $client->getResponse()->getStatusCode());
    }
}
