<?php

namespace Incentives\CatalogoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ClienteControllerTest extends WebTestCase
{
    public function testNuevo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cliente/nuevo');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cliente/editar');
    }

    public function testDatos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cliente/datos/{id}');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cliente');
    }

    public function testEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/cliente/estado/{id}');
    }

}
