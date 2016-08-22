<?php

namespace Incentives\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventarioHistorico
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class InventarioHistorico
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
     * @var string
     * @ORM\ManyToOne(targetEntity="Inventario", inversedBy="historico", cascade={"persist"})
     * @ORM\JoinColumn(name="inventario_id", referencedColumnName="id", nullable=true)
     */
    protected $inventario;
    
    /**
     * @var float
     *
     * @ORM\Column(name="valorCompra", type="float", nullable=true)
     */
    private $valorCompra;

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
     * @ORM\Column(name="codigo", type="bigint", nullable=true)
     */
    private $codigo;

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
     * Set ingreso
     *
     * @param boolean $ingreso
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * @param integer $codigo
     * @return InventarioHistorico
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return integer 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set producto
     *
     * @param \Incentives\CatalogoBundle\Entity\Producto $producto
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * Set inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return InventarioHistorico
     */
    public function setInventario(\Incentives\InventarioBundle\Entity\Inventario $inventario = null)
    {
        $this->inventario = $inventario;
    
        return $this;
    }

    /**
     * Get inventario
     *
     * @return \Incentives\InventarioBundle\Entity\Inventario 
     */
    public function getInventario()
    {
        return $this->inventario;
    }

    /**
     * Set planilla
     *
     * @param \Incentives\InventarioBundle\Entity\Planilla $planilla
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return InventarioHistorico
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
     * @return InventarioHistorico
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
     * Set valorCompra
     *
     * @param float $valorCompra
     * @return InventarioHistorico
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
     * Set ordenproducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenproducto
     * @return InventarioHistorico
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
     * Set solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     * @return InventarioHistorico
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
}