<?php

namespace Incentives\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventario
 *
 * @ORM\Table(name="Inventario")
 * @ORM\Entity
 */
class Inventario
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
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Producto", inversedBy="inventario")
     * @ORM\JoinColumn(name="producto_id", referencedColumnName="id", nullable=true)
     */
    protected $producto;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Convocatorias", inversedBy="inventario")
     * @ORM\JoinColumn(name="convocatoria_id", referencedColumnName="id", nullable=true)
     */
    protected $convocatoria;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\RedencionesBundle\Entity\Redenciones", inversedBy="inventario")
     * @ORM\JoinColumn(name="redencion_id", referencedColumnName="id", nullable=true)
     */
    protected $redencion;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\RedencionesBundle\Entity\RedencionesProductos", inversedBy="inventario")
     * @ORM\JoinColumn(name="redencionProducto_id", referencedColumnName="id", nullable=true)
     */
    protected $redencionProducto;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\SolicitudesBundle\Entity\Solicitud")
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $solicitud;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\InventarioBundle\Entity\Planilla", inversedBy="inventario")
     * @ORM\JoinColumn(name="planilla_id", referencedColumnName="id", nullable=true)
     */
    protected $planilla;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesCompra", inversedBy="inventario")
     * @ORM\JoinColumn(name="orden_id", referencedColumnName="id", nullable=true)
     */
    protected $orden;
    
    /**
     * @ORM\ManyToOne(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", inversedBy="inventario")
     * @ORM\JoinColumn(name="ordenproducto_id", referencedColumnName="id", nullable=true)
     */
    protected $ordenproducto;
    
    /**
     * @ORM\ManyToOne(targetEntity="Incentives\InventarioBundle\Entity\Despachos", inversedBy="inventario")
     * @ORM\JoinColumn(name="despacho_id", referencedColumnName="id", nullable=true)
     */
    protected $despacho;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ingreso", type="boolean", nullable=true)
     */
    private $ingreso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="salio", type="boolean", nullable=true)
     */
    private $salio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEntrada", type="datetime", nullable=true)
     */
    private $fechaEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaSalida", type="datetime", nullable=true)
     */
    private $fechaSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=255, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @ORM\ManyToOne(targetEntity="Incentives\InventarioBundle\Entity\Requisicionesenvios", inversedBy="inventario")
     * @ORM\JoinColumn(name="envio_id", referencedColumnName="id", nullable=true)
     */
    protected $requisicionesesenvios;
    
    /**
     * @var float
     *
     * @ORM\Column(name="valorCompra", type="float", nullable=true)
     */
    private $valorCompra;
    
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
        $this->guia = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set ingreso
     *
     * @param boolean $ingreso
     *
     * @return Inventario
     */
    public function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;

        return $this;
    }

    /**
     * Get ingreso
     *
     * @return boolean
     */
    public function getIngreso()
    {
        return $this->ingreso;
    }

    /**
     * Set salio
     *
     * @param boolean $salio
     *
     * @return Inventario
     */
    public function setSalio($salio)
    {
        $this->salio = $salio;

        return $this;
    }

    /**
     * Get salio
     *
     * @return boolean
     */
    public function getSalio()
    {
        return $this->salio;
    }

    /**
     * Set fechaEntrada
     *
     * @param \DateTime $fechaEntrada
     *
     * @return Inventario
     */
    public function setFechaEntrada($fechaEntrada)
    {
        $this->fechaEntrada = $fechaEntrada;

        return $this;
    }

    /**
     * Get fechaEntrada
     *
     * @return \DateTime
     */
    public function getFechaEntrada()
    {
        return $this->fechaEntrada;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     *
     * @return Inventario
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     *
     * @return Inventario
     */
    public function setObservacion($observacion)
    {
        $this->observacion = $observacion;

        return $this;
    }

    /**
     * Get observacion
     *
     * @return string
     */
    public function getObservacion()
    {
        return $this->observacion;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Inventario
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set valorCompra
     *
     * @param float $valorCompra
     *
     * @return Inventario
     */
    public function setValorCompra($valorCompra)
    {
        $this->valorCompra = $valorCompra;

        return $this;
    }

    /**
     * Get valorCompra
     *
     * @return float
     */
    public function getValorCompra()
    {
        return $this->valorCompra;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     *
     * @return Inventario
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
     *
     * @return Inventario
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
     * Set convocatoria
     *
     * @param \Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria
     *
     * @return Inventario
     */
    public function setConvocatoria(\Incentives\OperacionesBundle\Entity\Convocatorias $convocatoria = null)
    {
        $this->convocatoria = $convocatoria;

        return $this;
    }

    /**
     * Get convocatoria
     *
     * @return \Incentives\OperacionesBundle\Entity\Convocatorias
     */
    public function getConvocatoria()
    {
        return $this->convocatoria;
    }

    /**
     * Set redencion
     *
     * @param \Incentives\RedencionesBundle\Entity\Redenciones $redencion
     *
     * @return Inventario
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
     * Set redencionProducto
     *
     * @param \Incentives\RedencionesBundle\Entity\RedencionesProductos $redencionProducto
     *
     * @return Inventario
     */
    public function setRedencionProducto(\Incentives\RedencionesBundle\Entity\RedencionesProductos $redencionProducto = null)
    {
        $this->redencionProducto = $redencionProducto;

        return $this;
    }

    /**
     * Get redencionProducto
     *
     * @return \Incentives\RedencionesBundle\Entity\RedencionesProductos
     */
    public function getRedencionProducto()
    {
        return $this->redencionProducto;
    }

    /**
     * Set solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     *
     * @return Inventario
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
     * Set planilla
     *
     * @param \Incentives\InventarioBundle\Entity\Planilla $planilla
     *
     * @return Inventario
     */
    public function setPlanilla(\Incentives\InventarioBundle\Entity\Planilla $planilla = null)
    {
        $this->planilla = $planilla;

        return $this;
    }

    /**
     * Get planilla
     *
     * @return \Incentives\InventarioBundle\Entity\Planilla
     */
    public function getPlanilla()
    {
        return $this->planilla;
    }

    /**
     * Set orden
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesCompra $orden
     *
     * @return Inventario
     */
    public function setOrden(\Incentives\OrdenesBundle\Entity\OrdenesCompra $orden = null)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesCompra
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set ordenproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenproducto
     *
     * @return Inventario
     */
    public function setOrdenproducto(\Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenproducto = null)
    {
        $this->ordenproducto = $ordenproducto;

        return $this;
    }

    /**
     * Get ordenproducto
     *
     * @return \Incentives\OrdenesBundle\Entity\OrdenesProducto
     */
    public function getOrdenproducto()
    {
        return $this->ordenproducto;
    }

    /**
     * Set despacho
     *
     * @param \Incentives\InventarioBundle\Entity\Despachos $despacho
     *
     * @return Inventario
     */
    public function setDespacho(\Incentives\InventarioBundle\Entity\Despachos $despacho = null)
    {
        $this->despacho = $despacho;

        return $this;
    }

    /**
     * Get despacho
     *
     * @return \Incentives\InventarioBundle\Entity\Despachos
     */
    public function getDespacho()
    {
        return $this->despacho;
    }

    /**
     * Add guium
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guium
     *
     * @return Inventario
     */
    public function addGuium(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guium)
    {
        $this->guia[] = $guium;

        return $this;
    }

    /**
     * Remove guium
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guium
     */
    public function removeGuium(\Incentives\RedencionesBundle\Entity\GuiaEnvio $guium)
    {
        $this->guia->removeElement($guium);
    }

    /**
     * Get guia
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuia()
    {
        return $this->guia;
    }

    /**
     * Set requisicionesesenvios
     *
     * @param \Incentives\InventarioBundle\Entity\Requisicionesenvios $requisicionesesenvios
     *
     * @return Inventario
     */
    public function setRequisicionesesenvios(\Incentives\InventarioBundle\Entity\Requisicionesenvios $requisicionesesenvios = null)
    {
        $this->requisicionesesenvios = $requisicionesesenvios;

        return $this;
    }

    /**
     * Get requisicionesesenvios
     *
     * @return \Incentives\InventarioBundle\Entity\Requisicionesenvios
     */
    public function getRequisicionesesenvios()
    {
        return $this->requisicionesesenvios;
    }

    /**
     * Set usuario
     *
     * @param \Incentives\BaseBundle\Entity\Usuario $usuario
     *
     * @return Inventario
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
