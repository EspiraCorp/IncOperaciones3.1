<?php

namespace Incentives\OrdenesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * OrdenesCompra
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class OrdenesCompraHistorico
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
     * @ORM\Column(name="consecutivo", type="string", length=255, nullable=true)
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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaVencimiento", type="date", nullable=true)
     */
    private $fechaVencimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRecepcion", type="date", nullable=true)
     */
    private $fechaRecepcion;

    /**
     * @var text
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cancelado", type="boolean", nullable=true)
     */
    private $cancelado;

    /**
     * @ORM\OneToMany(targetEntity="OrdenesProducto", mappedBy="ordenesCompra")
     * 
     */
    protected $ordenesProducto;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Inventario", mappedBy="orden", cascade={"persist"})
     * 
     */
    protected $inventario;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Proveedores", inversedBy="ordenescompra", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="proveedor_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $proveedor;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="OrdenesTipo", inversedBy="ordenesCompra", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordenesTipo_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenesTipo;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="OrdenesEstado", inversedBy="ordenesCompra")
     * @ORM\JoinColumn(name="ordenesEstado_id", referencedColumnName="id", nullable=true)
     */
    protected $ordenesEstado;

	/**
     * @var bigint
     *
     * @ORM\Column(name="total", type="bigint", nullable=true)
     */
    private $total;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="OrdenesCompra", inversedBy="ordeneshistorico", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordencompra_id", referencedColumnName="id")
     * 
     */
    protected $ordencompra;

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
        $this->fechaCreacion = new \DateTime("now");
        $this->cancelado = false;
        $this->ordenesEstado = 1;
        $this->ordenesProducto = new ArrayCollection();
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return OrdenesCompra
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
     * Set estado
     *
     * @param integer $estado
     * @return OrdenesCompra
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     * @return OrdenesCompra
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
     * Set numeroOrden
     *
     * @param integer $numeroOrden
     * @return OrdenesCompra
     */
    public function setNumeroOrden($numeroOrden)
    {
        $this->numeroOrden = $numeroOrden;
    
        return $this;
    }

    /**
     * Get numeroOrden
     *
     * @return integer 
     */
    public function getNumeroOrden()
    {
        return $this->numeroOrden;
    }

    /**
     * Set fechaVencimiento
     *
     * @param \DateTime $fechaVencimiento
     * @return OrdenesCompra
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
     * Set fechaRecepcion
     *
     * @param \DateTime $fechaRecepcion
     * @return OrdenesCompra
     */
    public function setFechaRecepcion($fechaRecepcion)
    {
        $this->fechaRecepcion = $fechaRecepcion;
    
        return $this;
    }

    /**
     * Get fechaRecepcion
     *
     * @return \DateTime 
     */
    public function getFechaRecepcion()
    {
        return $this->fechaRecepcion;
    }

    /**
     * Set cancelado
     *
     * @param boolean $cancelado
     * @return OrdenesCompra
     */
    public function setCancelado($cancelado)
    {
        $this->cancelado = $cancelado;
    
        return $this;
    }

    /**
     * Get cancelado
     *
     * @return boolean 
     */
    public function getCancelado()
    {
        return $this->cancelado;
    }

    /**
     * Set ordenesEstado
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesEstado $ordenesEstado
     * @return OrdenesCompra
     */
    public function setOrdenesEstado(\Incentives\OrdenessBundle\Entity\OrdenesEstado $ordenesEstado = null)
    {
        $this->ordenesEstado = $ordenesEstado;
    
        return $this;
    }

    /**
     * Get ordenesEstado
     *
     * @return \Incentives\OrdenessBundle\Entity\OrdenesEstado 
     */
    public function getOrdenesEstado()
    {
        return $this->ordenesEstado;
    }

    /**
     * Set consecutivo
     *
     * @param integer $consecutivo
     * @return OrdenesCompra
     */
    public function setConsecutivo($consecutivo)
    {
        $this->consecutivo = $consecutivo;
    
        return $this;
    }

    /**
     * Get consecutivo
     *
     * @return integer 
     */
    public function getConsecutivo()
    {
        return $this->consecutivo;
    }


    /**
     * Add ordenesProducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesProducto
     * @return OrdenesCompra
     */
    public function addOrdenesProducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesProducto)
    {
        $this->ordenesProducto[] = $ordenesProducto;
    
        return $this;
    }

    /**
     * Remove ordenesProducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesProducto
     */
    public function removeOrdenesProducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesProducto)
    {
        $this->ordenesProducto->removeElement($ordenesProducto);
    }

    /**
     * Get ordenesProducto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrdenesProducto()
    {
        return $this->ordenesProducto;
    }

    /**
     * Set ordenesTipo
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesTipo $ordenesTipo
     * @return OrdenesCompra
     */
    public function setOrdenesTipo(\Incentives\OrdenesBundle\Entity\OrdenesTipo $ordenesTipo = null)
    {
        $this->ordenesTipo = $ordenesTipo;
    
        return $this;
    }

    /**
     * Get ordenesTipo
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesTipo 
     */
    public function getOrdenesTipo()
    {
        return $this->ordenesTipo;
    }

    /**
     * Set rutapdf
     *
     * @param string $rutapdf
     * @return OrdenesCompra
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
     * Add inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return OrdenesCompra
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
     * Set ordencompra
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra
     * @return OrdenesCompraHistorico
     */
    public function setOrdencompra(\Incentives\OrdenesBundle\Entity\OrdenesCompra $ordencompra = null)
    {
        $this->ordencompra = $ordencompra;
    
        return $this;
    }

    /**
     * Get ordencompra
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesCompra 
     */
    public function getOrdencompra()
    {
        return $this->ordencompra;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     * @return OrdenesCompraHistorico
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
     * Set total
     *
     * @param integer $total
     * @return OrdenesCompraHistorico
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
     * Set proveedor
     *
     * @param \Incentives\OperacionesBundle\Entity\Proveedores $proveedor
     * @return OrdenesCompraHistorico
     */
    public function setProveedor(\Incentives\OperacionesBundle\Entity\Proveedores $proveedor = null)
    {
        $this->proveedor = $proveedor;
    
        return $this;
    }

    /**
     * Get proveedor
     *
     * @return \Incentives\OperacionesBundle\Entity\Proveedores 
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return OrdenesCompraHistorico
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
}