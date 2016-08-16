<?php

namespace Incentives\SolicitudesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cotizacion
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Cotizacion
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
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\FacturaLogistica")
     * @ORM\JoinColumn(name="facturaLogistica_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $facturaLogistica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @var text
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var text
     *
     * @ORM\Column(name="condiciones", type="text", nullable=true)
     */
    private $condiciones;

    /**
     * @var bigint
     *
     * @ORM\Column(name="logistica", type="bigint", nullable=true)
     */
    private $logistica;

     /**
     * @var bigint
     *
     * @ORM\Column(name="total", type="bigint", nullable=true)
     */
    private $total;
    
    /**
     * @ORM\ManyToOne(targetEntity="Incentives\SolicitudesBundle\Entity\CotizacionesEstado")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;
    
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
     * Set consecutivo
     *
     * @param string $consecutivo
     * @return Cotizacion
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
     * @return Cotizacion
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
     * @return Cotizacion
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
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     * @return Cotizacion
     */
    public function setFechaVencimiento($fechaVencimiento)
    {
        $this->fechaVencimiento = $fechaVencimiento;
    
        return $this;
    }

    /**
     * Get fechaVencimiento
     *
     * @return \DateTime 
     */
    public function getFechaVencimiento()
    {
        return $this->fechaVencimiento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return Cotizacion
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
     * Set total
     *
     * @param integer $total
     * @return Cotizacion
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     * @return Cotizacion
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
     * Constructor
     */
    public function __construct()
    {
        $this->cotizacionProducto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add cotizacionProducto
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionProducto $cotizacionProducto
     * @return Cotizacion
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
     * Set logistica
     *
     * @param integer $logistica
     * @return Cotizacion
     */
    public function setLogistica($logistica)
    {
        $this->logistica = $logistica;
    
        return $this;
    }

    /**
     * Get logistica
     *
     * @return integer 
     */
    public function getLogistica()
    {
        return $this->logistica;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Cotizacion
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
     * @return Cotizacion
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
     * Set condiciones
     *
     * @param string $condiciones
     * @return Cotizacion
     */
    public function setCondiciones($condiciones)
    {
        $this->condiciones = $condiciones;
    
        return $this;
    }

    /**
     * Get condiciones
     *
     * @return string 
     */
    public function getCondiciones()
    {
        return $this->condiciones;
    }

    /**
     * Set estado
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionesEstado $estado
     * @return Cotizacion
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
    
    /**
     * Set facturaLogistica
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaLogistica $facturaLogistica
     * @return Cotizacion
     */
    public function setFacturaLogistica(\Incentives\FacturacionBundle\Entity\FacturaLogistica $facturaLogistica = null)
    {
        $this->facturaLogistica = $facturaLogistica;
    
        return $this;
    }

    /**
     * Get facturaLogistica
     *
     * @return \Incentives\FacturacionBundle\Entity\FacturaLogistica 
     */
    public function getFacturaLogistica()
    {
        return $this->facturaLogistica;
    }
}
