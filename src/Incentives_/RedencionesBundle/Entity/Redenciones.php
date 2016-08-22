<?php

namespace Incentives\RedencionesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Redenciones
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Table(name="Redenciones")
 */
class Redenciones
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
     * @ORM\ManyToOne(targetEntity="Participantes", inversedBy="redencion")
     * @ORM\JoinColumn(name="participante_id", referencedColumnName="id", nullable=true)
     */
    protected $participante;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Productocatalogo", inversedBy="redencion")
     * @ORM\JoinColumn(name="productocatalogo_id", referencedColumnName="id", nullable=true)
     */
    protected $productocatalogo;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Redencionesestado", inversedBy="redencion")
     * @ORM\JoinColumn(name="redencionestado_id", referencedColumnName="id", nullable=true)
     */
    protected $redencionestado;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\OrdenesBundle\Entity\OrdenesProducto", inversedBy="redenciones", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="ordenesProducto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $ordenesProducto;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\FacturacionBundle\Entity\FacturaProductos", inversedBy="redenciones", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="facturaProducto_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $facturaProducto;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\FacturacionBundle\Entity\FacturaDetalle", mappedBy="redencion", cascade={"persist"})
     * 
     */
    protected $facturaciondetalle;

    /**
     * @var float
     *
     * @ORM\Column(name="valor", type="float", nullable=true)
     */
    private $valor;

    /**
     * @var float
     *
     * @ORM\Column(name="valorLogistica", type="float", nullable=true)
     */
    private $valorLogistica;

    /**
     * @var float
     *
     * @ORM\Column(name="valorOrden", type="float", nullable=true)
     */
    private $valorOrden;

    /**
     * @var float
     *
     * @ORM\Column(name="valorCompra", type="float", nullable=true)
     */
    private $valorCompra;
    
    /**
     * @var float
     *
     * @ORM\Column(name="descuento", type="float", nullable=true)
     */
    private $descuento;

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
     * @var integer
     *
     * @ORM\Column(name="diasEntrega", type="integer", nullable=true)
     */
    private $diasEntrega;
 
     /**
     * @var float
     *
     * @ORM\Column(name="puntos", type="float", nullable=true)
     */
    private $puntos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAutorizacion", type="datetime", nullable=true)
     */
    private $fechaAutorizacion;

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
     * @var string
     *
     * @ORM\Column(name="observacion", type="string", length=500, nullable=true)
     */
    private $observacion;

    /**
     * @var string
     *
     * @ORM\Column(name="otros", type="string", length=500, nullable=true)
     */
    private $otros;


    /**
     * @var string
     *
     * @ORM\Column(name="redimidopor", type="string", length=30, nullable=true)
     */
    private $redimidopor;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoredencion", type="string", length=255, nullable=true)
     */
    private $codigoredencion;

    /**
     * @var string
     *
     * @ORM\Column(name="totalPass", type="string", length=255, nullable=true)
     */
    private $totalPass;

    /**
     * @var string
     *
     * @ORM\Column(name="mensajeTotalPass", type="string", length=255, nullable=true)
     */
    private $mensajeTotalPass;  

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
     * @ORM\OneToMany(targetEntity="RedencionesHistorico", mappedBy="redencion", cascade={"persist"})
     * 
     */
    protected $historico;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\GarantiasBundle\Entity\Novedades", mappedBy="redencion", cascade={"persist"})
     * 
     */
    protected $novedad;

    /**
     * @ORM\OneToMany(targetEntity="Redencionesenvios", mappedBy="redencion", cascade={"persist"})
     */
    protected $redencionesenvios;

    /**
     * @ORM\OneToMany(targetEntity="Redencionesatributos", mappedBy="redencion", cascade={"persist"})
     */
    protected $atributos;

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
     * @ORM\ManyToOne(targetEntity="Justificacion", inversedBy="redencion")
     * @ORM\JoinColumn(name="justificacion_id", referencedColumnName="id", nullable=true)
     */
    protected $justificacion;
    
    /**
     * @var text
     *
     * @ORM\Column(name="observacionJustificacion", type="text", nullable=true)
     */
    private $observacionJustificacion;

    public function __construct()
    {
        $this->inventario = new ArrayCollection();
        $this->historico = new ArrayCollection();
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
     * Set valor
     *
     * @param float $valor
     * @return Redenciones
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    
        return $this;
    }

    /**
     * Get valor
     *
     * @return float 
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Redenciones
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
     * Set atributos
     *
     * @param string $atributos
     * @return Redenciones
     */
    public function setAtributos($atributos)
    {
        $this->atributos = $atributos;
    
        return $this;
    }

    /**
     * Get atributos
     *
     * @return string 
     */
    public function getAtributos()
    {
        return $this->atributos;
    }

    /**
     * Set codigoredencion
     *
     * @param string $codigoredencion
     * @return Redenciones
     */
    public function setCodigoredencion($codigoredencion)
    {
        $this->codigoredencion = $codigoredencion;
    
        return $this;
    }

    /**
     * Get codigoredencion
     *
     * @return string 
     */
    public function getCodigoredencion()
    {
        return $this->codigoredencion;
    }

     /**
     * Get totalPass
     *
     * @return string 
     */
    public function getTotalPass()
    {
        return $this->totalPass;
    }
    
    /**
     * Set totalPass
     *
     * @param string $totalPass
     * @return Redenciones
     */
    public function setTotalPass($totalPass)
    {
        $this->totalPass = $totalPass;
    
        return $this;
    }

    /**
     * Get mensajeTotalPass
     *
     * @return string 
     */
    public function getMensajeTotalPass()
    {
        return $this->mensajeTotalPass;
    }
    
    /**
     * Set mensajeTotalPass
     *
     * @param string $mensajeTotalPass
     * @return Redenciones
     */
    public function setMensajeTotalPass($mensajeTotalPass)
    {
        $this->mensajeTotalPass = $mensajeTotalPass;
    
        return $this;
    }

    /**
     * Set participante
     *
     * @param \Incentives\RedencionesBundle\Entity\Participantes $participante
     * @return Redenciones
     */
    public function setParticipante(\Incentives\RedencionesBundle\Entity\Participantes $participante = null)
    {
        $this->participante = $participante;
    
        return $this;
    }

    /**
     * Get participante
     *
     * @return \Incentives\RedencionesBundle\Entity\Participantes 
     */
    public function getParticipante()
    {
        return $this->participante;
    }

    /**
     * Set productocatalogo
     *
     * @param \Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo
     * @return Redenciones
     */
    public function setProductocatalogo(\Incentives\CatalogoBundle\Entity\Productocatalogo $productocatalogo = null)
    {
        $this->productocatalogo = $productocatalogo;
    
        return $this;
    }

    /**
     * Get productocatalogo
     *
     * @return \Incentives\CatalogoBundle\Entity\Productocatalogo 
     */
    public function getProductocatalogo()
    {
        return $this->productocatalogo;
    }

    /**
     * Set redencionestado
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesestado $redencionestado
     * @return Redenciones
     */
    public function setRedencionestado(\Incentives\RedencionesBundle\Entity\Redencionesestado $redencionestado = null)
    {
        $this->redencionestado = $redencionestado;
    
        return $this;
    }

    /**
     * Get redencionestado
     *
     * @return \Incentives\RedencionesBundle\Entity\Redencionesestado 
     */
    public function getRedencionestado()
    {
        return $this->redencionestado;
    }

    /**
     * Add guiaEnvio
     *
     * @param \Incentives\RedencionesBundle\Entity\GuiaEnvio $guiaEnvio
     * @return Redenciones
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
     * Add inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return Redenciones
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
     * Add historico
     *
     * @param \Incentives\RedencionesBundle\Entity\RedencionesHistorico $historico
     * @return Redenciones
     */
    public function addHistorico(\Incentives\RedencionesBundle\Entity\RedencionesHistorico $historico)
    {
        $this->historico[] = $historico;
    
        return $this;
    }

    /**
     * Remove historico
     *
     * @param \Incentives\RedencionesBundle\Entity\RedencionesHistorico $historico
     */
    public function removeHistorico(\Incentives\RedencionesBundle\Entity\RedencionesHistorico $historico)
    {
        $this->historico->removeElement($historico);
    }

    /**
     * Get historico
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHistorico()
    {
        return $this->historico;
    }

    /**
     * Add redencionesenvios
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionesenvios
     * @return Redenciones
     */
    public function addRedencionesenvio(\Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionesenvios)
    {
        $this->redencionesenvios[] = $redencionesenvios;
    
        return $this;
    }

    /**
     * Remove redencionesenvios
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionesenvios
     */
    public function removeRedencionesenvio(\Incentives\RedencionesBundle\Entity\Redencionesenvios $redencionesenvios)
    {
        $this->redencionesenvios->removeElement($redencionesenvios);
    }

    /**
     * Get redencionesenvios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRedencionesenvios()
    {
        return $this->redencionesenvios;
    }

    /**
     * Set observacion
     *
     * @param string $observacion
     * @return Redenciones
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
     * Add novedad
     *
     * @param \Incentives\GarantiasBundle\Entity\Novedades $novedad
     * @return Redenciones
     */
    public function addNovedad(\Incentives\GarantiasBundle\Entity\Novedades $novedad)
    {
        $this->novedad[] = $novedad;
    
        return $this;
    }

    /**
     * Remove novedad
     *
     * @param \Incentives\GarantiasBundle\Entity\Novedades $novedad
     */
    public function removeNovedad(\Incentives\GarantiasBundle\Entity\Novedades $novedad)
    {
        $this->novedad->removeElement($novedad);
    }

    /**
     * Get novedad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNovedad()
    {
        return $this->novedad;
    }

    /**
     * Add atributos
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesatributos $atributos
     * @return Redenciones
     */
    public function addAtributo(\Incentives\RedencionesBundle\Entity\Redencionesatributos $atributos)
    {
        $this->atributos[] = $atributos;
    
        return $this;
    }

    /**
     * Remove atributos
     *
     * @param \Incentives\RedencionesBundle\Entity\Redencionesatributos $atributos
     */
    public function removeAtributo(\Incentives\RedencionesBundle\Entity\Redencionesatributos $atributos)
    {
        $this->atributos->removeElement($atributos);
    }

    /**
     * Add facturaciondetalle
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaDetalle $facturaciondetalle
     * @return Redenciones
     */
    public function addFacturaciondetalle(\Incentives\FacturacionBundle\Entity\FacturaDetalle $facturaciondetalle)
    {
        $this->facturaciondetalle[] = $facturaciondetalle;
    
        return $this;
    }

    /**
     * Remove facturaciondetalle
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaDetalle $facturaciondetalle
     */
    public function removeFacturaciondetalle(\Incentives\FacturacionBundle\Entity\FacturaDetalle $facturaciondetalle)
    {
        $this->facturaciondetalle->removeElement($facturaciondetalle);
    }

    /**
     * Get facturaciondetalle
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFacturaciondetalle()
    {
        return $this->facturaciondetalle;
    }

    /**
     * Set ordenesProducto
     *
     * @param \Incentives\OrdenesBundle\Entity\OrdenesProducto $ordenesProducto
     * @return Redenciones
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

    /**
     * Set otros
     *
     * @param string $otros
     * @return Redenciones
     */
    public function setOtros($otros)
    {
        $this->otros = $otros;
    
        return $this;
    }

    /**
     * Get otros
     *
     * @return string 
     */
    public function getOtros()
    {
        return $this->otros;
    }

    /**
     * Set redimidopor
     *
     * @param string $redimidopor
     * @return Redenciones
     */
    public function setRedimidopor($redimidopor)
    {
        $this->redimidopor = $redimidopor;
    
        return $this;
    }

    /**
     * Get redimidopor
     *
     * @return string 
     */
    public function getRedimidopor()
    {
        return $this->redimidopor;
    }

    /**
     * Set puntos
     *
     * @param float $puntos
     * @return Redenciones
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;
    
        return $this;
    }

    /**
     * Get puntos
     *
     * @return float 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

   /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Redenciones
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
     * Set fechaAutorizacion
     *
     * @param \DateTime $fechaAutorizacion
     * @return Redenciones
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
     * Set fechaDespacho
     *
     * @param \DateTime $fechaDespacho
     * @return Redenciones
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
     * Set facturaProducto
     *
     * @param \Incentives\FacturacionBundle\Entity\FacturaProductos $facturaProducto
     * @return Redenciones
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
     * @return Redenciones
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
     * Set valorOrden
     *
     * @param float $valorOrden
     * @return Redenciones
     */
    public function setValorOrden($valorOrden)
    {
        $this->valorOrden = $valorOrden;
    
        return $this;
    }

    /**
     * Get valorOrden
     *
     * @return float 
     */
    public function getValorOrden()
    {
        return $this->valorOrden;
    }

    /**
     * Set valorCompra
     *
     * @param float $valorCompra
     * @return Redenciones
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
     * Set incremento
     *
     * @param float $incremento
     * @return Redenciones
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
     * @param float $logistica
     * @return Redenciones
     */
    public function setLogistica($logistica)
    {
        $this->logistica = $logistica;
    
        return $this;
    }

    /**
     * Get logistica
     *
     * @return float 
     */
    public function getLogistica()
    {
        return $this->logistica;
    }

    /**
     * Set diasEntrega
     *
     * @param integer $diasEntrega
     * @return Redenciones
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
     * Set valorLogistica
     *
     * @param float $valorLogistica
     * @return Redenciones
     */
    public function setValorLogistica($valorLogistica)
    {
        $this->valorLogistica = $valorLogistica;
    
        return $this;
    }

    /**
     * Get valorLogistica
     *
     * @return float 
     */
    public function getValorLogistica()
    {
        return $this->valorLogistica;
    }

    /**
     * Set justificacion
     *
     * @param \Incentives\RedencionesBundle\Entity\Justificacion $justificacion
     * @return Redenciones
     */
    public function setJustificacion(\Incentives\RedencionesBundle\Entity\Justificacion $justificacion = null)
    {
        $this->justificacion = $justificacion;
    
        return $this;
    }

    /**
     * Get justificacion
     *
     * @return \Incentives\RedencionesBundle\Entity\Justificacion 
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set descuento
     *
     * @param float $descuento
     * @return Redenciones
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
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     * @return Redenciones
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
     * Set observacionJustificacion
     *
     * @param string $observacionJustificacion
     * @return Redenciones
     */
    public function setObservacionJustificacion($observacionJustificacion)
    {
        $this->observacionJustificacion = $observacionJustificacion;
    
        return $this;
    }

    /**
     * Get observacionJustificacion
     *
     * @return string 
     */
    public function getObservacionJustificacion()
    {
        return $this->observacionJustificacion;
    }

    /**
     * Add despacho
     *
     * @param \Incentives\InventarioBundle\Entity\Despachos $despacho
     * @return Redenciones
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
}
