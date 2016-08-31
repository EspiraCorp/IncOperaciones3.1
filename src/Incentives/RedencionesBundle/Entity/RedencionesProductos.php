<?php

namespace Incentives\RedencionesBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * RedencionesProductos
 *
 * @ORM\Entity
 * @ORM\Table(name="RedencionesProductos")
 */
class RedencionesProductos
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
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", inversedBy="redencionesPreoductos", cascade={"persist"})
     * @ORM\JoinColumn(name="redencion_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $redencion;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Producto", inversedBy="premiosproductos", cascade={"persist"})
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $producto;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Redencionesestado")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     */
    protected $estado;

    /**
     * @var float
     *
     * @ORM\Column(name="precioLogistica", type="float", nullable=true)
     */
    private $precioLogistica;

    /**
     * @var float
     *
     * @ORM\Column(name="precioCompra", type="float", nullable=true)
     */
    private $precioCompra;

    /**
     * @var float
     *
     * @ORM\Column(name="descuento", type="float", nullable=true)
     */
    private $descuento;

     /**
     * @var integer
     *
     * @ORM\Column(name="diasEntrega", type="integer", nullable=true)
     */
    private $diasEntrega;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAutorizacion", type="datetime", nullable=true)
     */
    private $fechaAutorizacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaDespacho", type="datetime", nullable=true)
     */
    private $fechaDespacho;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEntrega", type="datetime", nullable=true)
     */
    private $fechaEntrega;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Inventario", mappedBy="redencion", cascade={"persist"})
     * 
     */
    protected $inventario;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Despachos", mappedBy="redencion", cascade={"persist"})
     * 
     */
    protected $despacho;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", inversedBy="redencionesProductos", cascade={"persist"})
     * @ORM\JoinColumn(name="ordenesProducto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenesProducto;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\FacturaProductos", inversedBy="redencionesProductos", cascade={"persist"})
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

    public function __construct()
    {
        $this->redencion = new ArrayCollection();
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
     * Set precioLogistica
     *
     * @param float $precioLogistica
     *
     * @return RedencionesProductos
     */
    public function setPrecioLogistica($precioLogistica)
    {
        $this->precioLogistica = $precioLogistica;

        return $this;
    }

    /**
     * Get precioLogistica
     *
     * @return float
     */
    public function getPrecioLogistica()
    {
        return $this->precioLogistica;
    }

    /**
     * Set precioCompra
     *
     * @param float $precioCompra
     *
     * @return RedencionesProductos
     */
    public function setPrecioCompra($precioCompra)
    {
        $this->precioCompra = $precioCompra;

        return $this;
    }

    /**
     * Get precioCompra
     *
     * @return float
     */
    public function getPrecioCompra()
    {
        return $this->precioCompra;
    }

    /**
     * Set descuento
     *
     * @param float $descuento
     *
     * @return RedencionesProductos
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return float
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set diasEntrega
     *
     * @param integer $diasEntrega
     *
     * @return RedencionesProductos
     */
    public function setDiasEntrega($diasEntrega)
    {
        $this->diasEntrega = $diasEntrega;

        return $this;
    }

    /**
     * Get diasEntrega
     *
     * @return integer
     */
    public function getDiasEntrega()
    {
        return $this->diasEntrega;
    }

    /**
     * Set fechaAutorizacion
     *
     * @param \DateTime $fechaAutorizacion
     *
     * @return RedencionesProductos
     */
    public function setFechaAutorizacion($fechaAutorizacion)
    {
        $this->fechaAutorizacion = $fechaAutorizacion;

        return $this;
    }

    /**
     * Get fechaAutorizacion
     *
     * @return \DateTime
     */
    public function getFechaAutorizacion()
    {
        return $this->fechaAutorizacion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return RedencionesProductos
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set fechaDespacho
     *
     * @param \DateTime $fechaDespacho
     *
     * @return RedencionesProductos
     */
    public function setFechaDespacho($fechaDespacho)
    {
        $this->fechaDespacho = $fechaDespacho;

        return $this;
    }

    /**
     * Get fechaDespacho
     *
     * @return \DateTime
     */
    public function getFechaDespacho()
    {
        return $this->fechaDespacho;
    }

    /**
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return RedencionesProductos
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return RedencionesProductos
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
     * Set redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     *
     * @return RedencionesProductos
     */
    public function setRedencion(\Incentives\RedencionesBundle\Entity\Redenciones $redencion = null)
    {
        $this->redencion = $redencion;

        return $this;
    }

    /**
     * Get redencion
     *
     * @return \Incentives\RedencionesBundle\Entity\Redenciones
     */
    public function getRedencion()
    {
        return $this->redencion;
    }

    /**
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     *
     * @return RedencionesProductos
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
     * Set estado
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesestado $estado
     *
     * @return RedencionesProductos
     */
    public function setEstado(\Incentives\RedencionesBundle\Entity\Redencionesestado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \Incentives\RedencionesBundle\Entity\Redencionesestado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Add inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     *
     * @return RedencionesProductos
     */
    public function addInventario(\Incentives\InventarioBundle\Entity\Inventario $inventario)
    {
        $this->inventario[] = $inventario;

        return $this;
    }

    /**
     * Remove inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     */
    public function removeInventario(\Incentives\InventarioBundle\Entity\Inventario $inventario)
    {
        $this->inventario->removeElement($inventario);
    }

    /**
     * Get inventario
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInventario()
    {
        return $this->inventario;
    }

    /**
     * Add despacho
     *
     * @param \Incentives\InventarioBundle\Entity\Despachos $despacho
     *
     * @return RedencionesProductos
     */
    public function addDespacho(\Incentives\InventarioBundle\Entity\Despachos $despacho)
    {
        $this->despacho[] = $despacho;

        return $this;
    }

    /**
     * Remove despacho
     *
     * @param \Incentives\InventarioBundle\Entity\Despachos $despacho
     */
    public function removeDespacho(\Incentives\InventarioBundle\Entity\Despachos $despacho)
    {
        $this->despacho->removeElement($despacho);
    }

    /**
     * Get despacho
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDespacho()
    {
        return $this->despacho;
    }

    /**
     * Set facturaProducto
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaProductos $facturaProducto
     *
     * @return RedencionesProductos
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
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     *
     * @return RedencionesProductos
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
     * Set ordenesProducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesProducto
     *
     * @return RedencionesProductos
     */
    public function setOrdenesProducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesProducto = null)
    {
        $this->ordenesProducto = $ordenesProducto;

        return $this;
    }

    /**
     * Get ordenesProducto
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesProducto
     */
    public function getOrdenesProducto()
    {
        return $this->ordenesProducto;
    }
}
