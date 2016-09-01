<?php

namespace Incentives\SolicitudesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Requisicion
 *
 * @ORM\Table(name="Requisicion")
 * @ORM\Entity
 */
class Requisicion
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
     * @ORM\Column(name="consecutivo", type="string", length=255)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $consecutivo;

    /**
     * @var string
     *
     * @ORM\Column(name="rutapdf", type="string", length=255, nullable=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $rutapdf;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaCreacion", type="date", nullable=true)
     */
    private $fechaCreacion;

    /**
     * @var text
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Solicitud", inversedBy="cotizacion", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $solicitud;
    
    /**
     * @ORM\OneToMany(targetEntity="CotizacionProducto", mappedBy="cotizacion")
     * 
     */
    protected $cotizacionProducto;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\SolicitudesBundle\Entity\CotizacionesEstado")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;

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
     * Constructor
     */
    public function __construct()
    {
        $this->cotizacionProducto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set consecutivo
     *
     * @param string $consecutivo
     * @return Requisicion
     */
    public function setConsecutivo($consecutivo)
    {
        $this->consecutivo = $consecutivo;
    
        return $this;
    }

    /**
     * Get consecutivo
     *
     * @return string 
     */
    public function getConsecutivo()
    {
        return $this->consecutivo;
    }

    /**
     * Set rutapdf
     *
     * @param string $rutapdf
     * @return Requisicion
     */
    public function setRutapdf($rutapdf)
    {
        $this->rutapdf = $rutapdf;
    
        return $this;
    }

    /**
     * Get rutapdf
     *
     * @return string 
     */
    public function getRutapdf()
    {
        return $this->rutapdf;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Requisicion
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    
        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Requisicion
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;
    
        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string 
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Requisicion
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
     * Set solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     * @return Requisicion
     */
    public function setSolicitud(\Incentives\SolicitudesBundle\Entity\Solicitud $solicitud = null)
    {
        $this->solicitud = $solicitud;
    
        return $this;
    }

    /**
     * Get solicitud
     *
     * @return \Incentives\SolicitudesBundle\Entity\Solicitud 
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Add cotizacionProducto
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionProducto
     * @return Requisicion
     */
    public function addCotizacionProducto(\Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionProducto)
    {
        $this->cotizacionProducto[] = $cotizacionProducto;
    
        return $this;
    }

    /**
     * Remove cotizacionProducto
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionProducto
     */
    public function removeCotizacionProducto(\Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionProducto)
    {
        $this->cotizacionProducto->removeElement($cotizacionProducto);
    }

    /**
     * Get cotizacionProducto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCotizacionProducto()
    {
        return $this->cotizacionProducto;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return Requisicion
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

    /**
     * Set estado
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionesEstado $estado
     *
     * @return Requisicion
     */
    public function setEstado(\Incentives\SolicitudesBundle\Entity\CotizacionesEstado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\SolicitudesBundle\Entity\CotizacionesEstado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
