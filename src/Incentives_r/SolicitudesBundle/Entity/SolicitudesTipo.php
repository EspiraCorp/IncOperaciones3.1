<?php

namespace Incentives\SolicitudesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SolicitudesTipo
 * 
 * @ORM\Table(name="SolicitudesTipo")
 * 
 */
class SolicitudesTipo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $solicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=true)
     */
    private $fechaModificacion;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\BaseBundle\Entity\Usuario")
     * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $usuario;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->solicitud = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SolicitudesTipo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     * @return SolicitudesTipo
     */
    public function addSolicitud(\Incentives\SolicitudesBundle\Entity\Solicitud $solicitud)
    {
        $this->solicitud[] = $solicitud;
    
        return $this;
    }

    /**
     * Remove solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     */
    public function removeSolicitud(\Incentives\SolicitudesBundle\Entity\Solicitud $solicitud)
    {
        $this->solicitud->removeElement($solicitud);
    }

    /**
     * Get solicitud
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }
}
