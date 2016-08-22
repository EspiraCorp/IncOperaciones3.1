<?php

namespace Incentives\RedencionesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParticipanteControllerTest extends WebTestCase
{
    public function testNuevo()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/participante/nuevo');
    }

    public function testEditar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/participante/editar/{id}');
    }

    public function testListado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/participante');
    }

    public function testEstado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/participante/estado/{id}');
    }

}
