<?php

namespace Incentives\CatalogoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CatalogoControllerTest extends WebTestCase
{
    public function testNuevo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalogo/nuevo');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalogo/editar/{id}');
    }

    public function testDatos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalogo/datos/{id}');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalogo');
    }

    public function testEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/catalogo/estado/{id}');
    }

}
