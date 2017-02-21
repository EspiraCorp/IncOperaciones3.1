<?php

namespace Incentives\BaseBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Correos
 *
 * @ORM\Table(name="Correos")
 * @ORM\Entity(repositoryClass="Incentives\BaseBundle\Repository\CorreosRepository")
 */
class Correos
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="servicio", type="string", length=255, nullable=true)
     */
    private $servicio;

    /**
     * @var string
     *
     * @ORM\Column(name="correos", type="text")
     */
    private $correos;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set servicio
     *
     * @param string $servicio
     *
     * @return Correos
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set correos
     *
     * @param string $correos
     *
     * @return Correos
     */
    public function setCorreos($correos)
    {
        $this->correos = $correos;

        return $this;
    }

    /**
     * Get correos
     *
     * @return string
     */
    public function getCorreos()
    {
        return $this->correos;
    }
}
