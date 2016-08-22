<?php

namespace Incentives\OperacionesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConvocatoriasControllerTest extends WebTestCase
{
    public function testNueva()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/nueva');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editar');
    }

    public function testNotificar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/notificar');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/listado');
    }

    public function testDatos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/datos');
    }

    public function testProveedor()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/proveedor');
    }

}
