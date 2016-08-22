<?php

namespace Incentives\OperacionesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OdernesControllerTest extends WebTestCase
{
    public function testNuevo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nuevo');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listado');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editar');
    }

    public function testProveedor()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/proveedor');
    }

}
