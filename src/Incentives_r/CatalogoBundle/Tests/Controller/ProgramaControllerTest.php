<?php

namespace Incentives\CatalogoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProgramaControllerTest extends WebTestCase
{
    public function testNuevo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/programa/nuevo');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/programa/editar/{id}');
    }

    public function testDatos()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/programa/datos/{id}');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/programa');
    }

    public function testEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/programa/estado/{id}');
    }

}
