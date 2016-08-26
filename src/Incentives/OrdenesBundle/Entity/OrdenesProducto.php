<?php

namespace Incentives\OrdenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OrdenesProducto
 *
 * @ORM\Table(name="OrdenesProducto")
 * @ORM\Entity
 */
class OrdenesProducto
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
     * @var integer
     *
     * @ORM\Column(name="cantidadrecibida", type="integer", nullable=true)
     */
    private $cantidadrecibida;

    /**
     * @var float
     *
     * @ORM\Column(name="valorunidad", type="float", nullable=true)
     */
    private $valorunidad;

    /**
     * @var float
     *
     * @ORM\Column(name="valortotal", type="float", nullable=true)
     */
    private $valortotal;

    /**
     * @var float
     *
     * @ORM\Column(name="descuento", type="float", nullable=true)
     */
    private $descuento;
    
    /**
     * @var float
     *
     * @ORM\Column(name="precioCliente", type="float", nullable=true)
     */
    private $precioCliente;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="incremento", type="float", nullable=true)
     */
    private $incremento;

    /**
     * @var float
     *
     * @ORM\Column(name="logistica", type="float", nullable=true)
     */
    private $logistica;


    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\GuiaEnvio", mappedBy="ordenProducto", cascade={"persist"})
     * 
     */
    protected $guiaEnvio;

    /**
     * @var string
     *
     * @ORM\Column(name="centrocostos", type="string", length=255, nullable=true)
     */
    protected $centrocostos;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Producto", inversedBy="ordenesproducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $producto;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="OrdenesCompra", inversedBy="ordenesProducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordenesCompra_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenesCompra;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Programa", inversedBy="ordenesproducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="programa_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $programa;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\SolicitudesBundle\Entity\CotizacionProducto", inversedBy="ordenesproducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="productoCotizacion_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $productocotizacion;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Estados", inversedBy="ordenesproducto", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $estado;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", mappedBy="ordenesProducto")
     */
    protected $redenciones;
    
    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProductoHistorico", mappedBy="ordenproducto")
     * 
     */
    protected $ordenesproductohistorico;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Inventario", mappedBy="ordenproducto")
     * 
     */
    protected $inventario;


    /**
     * @ORM\OneToMany(targetEntity="Incentives\OrdenesBundle\Entity\Tracking", mappedBy="ordenproducto")
     * 
     */
    protected $tracking;
    
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

    public function __construct()
    {
        $this->redenciones = new ArrayCollection();
        $this->guiaEnvio = new ArrayCollection();
        $this->producto = new ArrayCollection();
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
     * Set cantidad
     *
     * @param integer $cantidad
     * @return OrdenesProducto
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
     * Set cantidadrecibida
     *
     * @param integer $cantidadrecibida
     * @return OrdenesProducto
     */
    public function setCantidadrecibida($cantidadrecibida)
    {
        $this->cantidadrecibida = $cantidadrecibida;
    
        return $this;
    }

    /**
     * Get cantidadrecibida
     *
     * @return integer 
     */
    public function getCantidadrecibida()
    {
        return $this->cantidadrecibida;
    }

    /**
     * Set valorunidad
     *
     * @param integer $valorunidad
     * @return OrdenesProducto
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
     * @return OrdenesProducto
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
     * @return OrdenesProducto
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
     * Set ordenesCompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra
     * @return OrdenesProducto
     */
    public function setOrdenesCompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordenesCompra = null)
    {
        $this->ordenesCompra = $ordenesCompra;
    
        return $this;
    }

    /**
     * Get ordenesCompra
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesCompra 
     */
    public function getOrdenesCompra()
    {
        return $this->ordenesCompra;
    }

    /**
     * Add guiaEnvio
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio
     * @return OrdenesProducto
     */
    public function addGuiaEnvio(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio)
    {
        $this->guiaEnvio[] = $guiaEnvio;
    
        return $this;
    }

    /**
     * Remove guiaEnvio
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio
     */
    public function removeGuiaEnvio(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio)
    {
        $this->guiaEnvio->removeElement($guiaEnvio);
    }

    /**
     * Get guiaEnvio
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGuiaEnvio()
    {
        return $this->guiaEnvio;
    }

    /**
     * Add redenciones
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redenciones
     * @return OrdenesProducto
     */
    public function addRedencione(\Incentives\RedencionesBundle\Entity\Redenciones $redenciones)
    {
        $this->redenciones[] = $redenciones;
    
        return $this;
    }

    /**
     * Remove redenciones
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redenciones
     */
    public function removeRedencione(\Incentives\RedencionesBundle\Entity\Redenciones $redenciones)
    {
        $this->redenciones->removeElement($redenciones);
    }

    /**
     * Get redenciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedenciones()
    {
        return $this->redenciones;
    }

    /**
     * Add ordenesproductohistorico
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProductoHistorico $ordenesproductohistorico
     * @return OrdenesProducto
     */
    public function addOrdenesproductohistorico(\Incentives\OrdenesBundle\Entity\OrdenesProductoHistorico $ordenesproductohistorico)
    {
        $this->ordenesproductohistorico[] = $ordenesproductohistorico;
    
        return $this;
    }

    /**
     * Remove ordenesproductohistorico
     *
     * @param \Incentives\OrdenessBundle\Entity\OrdenesProductoHistorico $ordenesproductohistorico
     */
    public function removeOrdenesproductohistorico(\Incentives\OrdenesBundle\Entity\OrdenesProductoHistorico $ordenesproductohistorico)
    {
        $this->ordenesproductohistorico->removeElement($ordenesproductohistorico);
    }

    /**
     * Get ordenesproductohistorico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenesproductohistorico()
    {
        return $this->ordenesproductohistorico;
    }

    /**
     * Set descuento
     *
     * @param integer $descuento
     * @return OrdenesProducto
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
     * Add tracking
     *
     * @param \Incentives\OrdenesBundle\Entity\Tracking $tracking
     * @return OrdenesProducto
     */
    public function addTracking(\Incentives\OrdenesBundle\Entity\Tracking $tracking)
    {
        $this->tracking[] = $tracking;
    
        return $this;
    }

    /**
     * Remove tracking
     *
     * @param \Incentives\OrdenesBundle\Entity\Tracking $tracking
     */
    public function removeTracking(\Incentives\OrdenesBundle\Entity\Tracking $tracking)
    {
        $this->tracking->removeElement($tracking);
    }

    /**
     * Get tracking
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTracking()
    {
        return $this->tracking;
    }


    /**
     * Set centrocostos
     *
     * @param string $centrocostos
     * @return OrdenesProducto
     */
    public function setCentrocostos($centrocostos)
    {
        $this->centrocostos = $centrocostos;
    
        return $this;
    }

    /**
     * Get centrocostos
     *
     * @return string 
     */
    public function getCentrocostos()
    {
        return $this->centrocostos;
    }


    /**
     * Set estado
     *
     * @param \Incentives\CatalogoBundle\Entity\Estados $estado
     * @return OrdenesProducto
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

    /**
     * Set programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return OrdenesProducto
     */
    public function setPrograma(\Incentives\CatalogoBundle\Entity\Programa $programa = null)
    {
        $this->programa = $programa;
    
        return $this;
    }

    /**
     * Get programa
     *
     * @return \Incentives\CatalogoBundle\Entity\Programa 
     */
    public function getPrograma()
    {
        return $this->programa;
    }

    /**
     * Set incremento
     *
     * @param integer $incremento
     * @return OrdenesProducto
     */
    public function setIncremento($incremento)
    {
        $this->incremento = $incremento;
    
        return $this;
    }

    /**
     * Get incremento
     *
     * @return integer 
     */
    public function getIncremento()
    {
        return $this->incremento;
    }

    /**
     * Set logistica
     *
     * @param integer $logistica
     * @return OrdenesProducto
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
     * Add inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return OrdenesProducto
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return OrdenesProducto
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
     * @return OrdenesProducto
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
     * Set productocotizacion
     *
     * @param \Incentives\SolicitudesBundle\Entity\CotizacionProducto $productocotizacion
     * @return OrdenesProducto
     */
    public function setProductocotizacion(\Incentives\SolicitudesBundle\Entity\CotizacionProducto $productocotizacion = null)
    {
        $this->productocotizacion = $productocotizacion;
    
        return $this;
    }

    /**
     * Get productocotizacion
     *
     * @return \Incentives\SolicitudesBundle\Entity\CotizacionProducto 
     */
    public function getProductocotizacion()
    {
        return $this->productocotizacion;
    }

    /**
     * Set facturaProducto
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaProductos $facturaProducto
     * @return OrdenesProducto
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
     * Set precioCliente
     *
     * @param float $precioCliente
     * @return OrdenesProducto
     */
    public function setPrecioCliente($precioCliente)
    {
        $this->precioCliente = $precioCliente;
    
        return $this;
    }

    /**
     * Get precioCliente
     *
     * @return float 
     */
    public function getPrecioCliente()
    {
        return $this->precioCliente;
    }
}
