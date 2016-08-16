<?php

namespace Incentives\RedencionesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrdenRedencionControllerTest extends WebTestCase
{
    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ordenredencion');
    }

    public function testGenerar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ordenredencion/generar');
    }

    public function testEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ordenredencion/estado/{id}');
    }

}
