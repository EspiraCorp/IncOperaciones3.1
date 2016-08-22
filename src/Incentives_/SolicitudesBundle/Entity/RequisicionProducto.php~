<?php

namespace Incentives\SolicitudesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * RequisicionProducto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class  RequisicionProducto
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
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var bigint
     *
     * @ORM\Column(name="valorunidad", type="bigint", nullable=true)
     */
    private $valorunidad;
    
    /**
     * @var float
     *
     * @ORM\Column(name="incremento", type="float", nullable=true)
     */
    private $incremento;

    /**
     * @var bigint
     *
     * @ORM\Column(name="valortotal", type="bigint", nullable=true)
     */
    private $valortotal;

    /**
     * @var bigint
     *
     * @ORM\Column(name="logistica", type="bigint", nullable=true)
     */
    private $logistica;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Producto", inversedBy="cotizacionproducto", cascade={"persist"})
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $producto;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Requisicion", inversedBy="requisicionProducto", cascade={"persist"})
     * @ORM\JoinColumn(name="requisicion_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $requisicion;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\FacturaProductos")
     * @ORM\JoinColumn(name="facturaProducto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $facturaProducto;

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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return RequisicionProducto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set valorunidad
     *
     * @param integer $valorunidad
     * @return RequisicionProducto
     */
    public function setValorunidad($valorunidad)
    {
        $this->valorunidad = $valorunidad;
    
        return $this;
    }

    /**
     * Get valorunidad
     *
     * @return integer 
     */
    public function getValorunidad()
    {
        return $this->valorunidad;
    }

    /**
     * Set incremento
     *
     * @param float $incremento
     * @return RequisicionProducto
     */
    public function setIncremento($incremento)
    {
        $this->incremento = $incremento;
    
        return $this;
    }

    /**
     * Get incremento
     *
     * @return float 
     */
    public function getIncremento()
    {
        return $this->incremento;
    }

    /**
     * Set valortotal
     *
     * @param integer $valortotal
     * @return RequisicionProducto
     */
    public function setValortotal($valortotal)
    {
        $this->valortotal = $valortotal;
    
        return $this;
    }

    /**
     * Get valortotal
     *
     * @return integer 
     */
    public function getValortotal()
    {
        return $this->valortotal;
    }

    /**
     * Set logistica
     *
     * @param integer $logistica
     * @return RequisicionProducto
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
     * @return RequisicionProducto
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
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return RequisicionProducto
     */
    public function setProducto(\Incentives\CatalogoBundle\Entity\Producto $producto = null)
    {
        $this->producto = $producto;
    
        return $this;
    }

    /**
     * Get producto
     *
     * @return \Incentives\CatalogoBundle\Entity\Producto 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set requisicion
     *
     * @param \Incentives\SolicitudesBundle\Entity\Requisicion $requisicion
     * @return RequisicionProducto
     */
    public function setRequisicion(\Incentives\SolicitudesBundle\Entity\Requisicion $requisicion = null)
    {
        $this->requisicion = $requisicion;
    
        return $this;
    }

    /**
     * Get requisicion
     *
     * @return \Incentives\SolicitudesBundle\Entity\Requisicion 
     */
    public function getRequisicion()
    {
        return $this->requisicion;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return RequisicionProducto
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
     * Set facturaProducto
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaProductos $facturaProducto
     * @return RequisicionProducto
     */
    public function setFacturaProducto(\Incentives\FacturacionBundle\Entity\FacturaProductos $facturaProducto = null)
    {
        $this->facturaProducto = $facturaProducto;
    
        return $this;
    }

    /**
     * Get facturaProducto
     *
     * @return \Incentives\FacturacionBundle\Entity\FacturaProductos 
     */
    public function getFacturaProducto()
    {
        return $this->facturaProducto;
    }
}