<?php

namespace Incentives\SolicitudesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CotizacionProducto
 *
 * @ORM\Table(name="CotizacionProducto")
 * @ORM\Entity
 */
class  CotizacionProducto
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
     * @ORM\ManyToOne(targetEntity="Cotizacion", inversedBy="cotizacionProducto", cascade={"persist"})
     * @ORM\JoinColumn(name="cotizacion_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $cotizacion;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", mappedBy="productocotizacion", cascade={"persist"})
     * 
     */
    protected $ordenesproducto;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesEstado", inversedBy="cotizacionproducto", cascade={"persist"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $estado;
    
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
     * @ORM\Column(name="fechaAprobacion", type="datetime", nullable=true)
     */
    private $fechaAprobacion;

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
     * @param \Incentives\SolicitudesBundle\Entity\Cotizacion $cotizacion
     * @return CotizacionProducto
     */
    public function setCotizacion(\Incentives\SolicitudesBundle\Entity\Cotizacion $cotizacion = null)
    {
        $this->cotizacion = $cotizacion;
    
        return $this;
    }

    /**
     * Get cotizacion
     *
     * @return \Incentives\SolicitudesBundle\Entity\Cotizacion 
     */
    public function getCotizacion()
    {
        return $this->cotizacion;
    }
    
    /**
     * Set incremento
     *
     * @param float $incremento
     * @return CotizacionProducto
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
     * Set logistica
     *
     * @param integer $logistica
     * @return CotizacionProducto
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
     * Set estado
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesEstado $estado
     * @return CotizacionProducto
     */
    public function setEstado(\Incentives\OrdenesBundle\Entity\OrdenesEstado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesEstado 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return CotizacionProducto
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
     * @return CotizacionProducto
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
     * Constructor
     */
    public function __construct()
    {
        $this->ordenesproducto = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add ordenesproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto
     * @return CotizacionProducto
     */
    public function addOrdenesproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto)
    {
        $this->ordenesproducto[] = $ordenesproducto;
    
        return $this;
    }

    /**
     * Remove ordenesproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto
     */
    public function removeOrdenesproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesproducto)
    {
        $this->ordenesproducto->removeElement($ordenesproducto);
    }

    /**
     * Get ordenesproducto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenesproducto()
    {
        return $this->ordenesproducto;
    }

    /**
     * Set facturaProducto
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaProductos $facturaProducto
     * @return CotizacionProducto
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

    /**
     * Set fechaAprobacion
     *
     * @param \DateTime $fechaAprobacion
     *
     * @return CotizacionProducto
     */
    public function setFechaAprobacion($fechaAprobacion)
    {
        $this->fechaAprobacion = $fechaAprobacion;

        return $this;
    }

    /**
     * Get fechaAprobacion
     *
     * @return \DateTime
     */
    public function getFechaAprobacion()
    {
        return $this->fechaAprobacion;
    }
}
