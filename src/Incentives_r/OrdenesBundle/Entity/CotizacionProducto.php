<?php

namespace Incentives\OrdenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CotizacionProducto
 * 
 * @ORM\Entity
 * @ORM\Table(name="CotizacionProducto")
 */
class CotizacionProducto
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var integer
     */
    private $valorunidad;

    /**
     * @var integer
     */
    private $valortotal;

    /**
     * @var integer
     */
    private $descuento;

    /**
     * @var \Incentives\CatalogoBundle\Entity\Producto
     */
    private $producto;

    /**
     * @var \Incentives\OrdenesBundle\Entity\Cotizacion
     */
    private $cotizacion;

    /**
     * @var \Incentives\CatalogoBundle\Entity\Estados
     */
    private $estado;

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
     * @return CotizacionProducto
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
     * @return CotizacionProducto
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
     * Set valortotal
     *
     * @param integer $valortotal
     * @return CotizacionProducto
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
     * Set descuento
     *
     * @param integer $descuento
     * @return CotizacionProducto
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    
        return $this;
    }

    /**
     * Get descuento
     *
     * @return integer 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return CotizacionProducto
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
     * Set cotizacion
     *
     * @param \Incentives\OrdenesBundle\Entity\Cotizacion $cotizacion
     * @return CotizacionProducto
     */
    public function setCotizacion(\Incentives\OrdenesBundle\Entity\Cotizacion $cotizacion = null)
    {
        $this->cotizacion = $cotizacion;
    
        return $this;
    }

    /**
     * Get cotizacion
     *
     * @return \Incentives\OrdenesBundle\Entity\Cotizacion 
     */
    public function getCotizacion()
    {
        return $this->cotizacion;
    }

    /**
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\Estados $estado
     * @return CotizacionProducto
     */
    public function setEstado(\Incentives\CatalogoBundle\Entity\Estados $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\CatalogoBundle\Entity\Estados 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
