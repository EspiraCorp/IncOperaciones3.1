<?php

namespace Incentives\InventarioBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CourierControllerTest extends WebTestCase
{
    public function testNuevo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/courier/crear');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/courier');
    }

    public function testDatos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/courier/datos/{id}');
    }

    public function testEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/courier/estado/{id}');
    }

}
