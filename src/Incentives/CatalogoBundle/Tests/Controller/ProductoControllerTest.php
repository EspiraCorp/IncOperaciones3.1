<?php

namespace Incentives\CatalogoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductoControllerTest extends WebTestCase
{
    public function testNuevo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/producto/nuevo');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/producto/editar');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/producto');
    }

    public function testDatos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/producto/{id}');
    }

    public function testCargaimagen()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/producto/imagen');
    }

}
