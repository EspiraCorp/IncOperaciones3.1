<?php

namespace Incentives\InventarioBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class InventarioControllerTest extends WebTestCase
{
    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/inventario');
    }

    public function testHistorico()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/inventario/historico/{id}');
    }

}
