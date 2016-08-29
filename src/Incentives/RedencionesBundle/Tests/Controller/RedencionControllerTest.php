<?php

namespace Incentives\RedencionesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RedencionControllerTest extends WebTestCase
{
    public function testNueva()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/redencion/nueva');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/redenciones');
    }

    public function testEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/redencion/estado/{id}');
    }

}
