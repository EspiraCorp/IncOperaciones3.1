<?php

namespace Incentives\GarantiasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Novedadesaccion
 *
 * @ORM\Entity
 * @ORM\Table(name="Novedadesaccion")
 */
class Novedadesaccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="Novedades", mappedBy="accion", cascade={"persist"})
     * 
     */
    protected $novedad;

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
     * @return Novedadesaccion
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
     * Constructor
     */
    public function __construct()
    {
        $this->novedad = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add novedad
     *
     * @param \Incentives\GarantiasBundle\Entity\Novedades $novedad
     * @return Novedadesaccion
     */
    public function addNovedad(\Incentives\GarantiasBundle\Entity\Novedades $novedad)
    {
        $this->novedad[] = $novedad;
    
        return $this;
    }

    /**
     * Remove novedad
     *
     * @param \Incentives\GarantiasBundle\Entity\Novedades $novedad
     */
    public function removeNovedad(\Incentives\GarantiasBundle\Entity\Novedades $novedad)
    {
        $this->novedad->removeElement($novedad);
    }

    /**
     * Get novedad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNovedad()
    {
        return $this->novedad;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Novedadesaccion
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    
        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return Novedadesaccion
     */
    public function setUsuario(\Incentives\BaseBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;
    
        return $this;
    }

    /**
     * Get usuario
     *
     * @return \Incentives\BaseBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
