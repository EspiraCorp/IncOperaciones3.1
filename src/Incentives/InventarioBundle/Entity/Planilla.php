<?php

namespace Incentives\InventarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Planilla
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Planilla
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
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="consecutivo", type="string", length=255, nullable=true)
     */
    private $consecutivo;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=true)
     */
    private $ruta;

     /**
     * 
     * @ORM\ManyToOne(targetEntity="PlanillaEstado", inversedBy="planilla", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="planillaEstado_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $planillaEstado;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\CatalogoBundle\Entity\Programa")
     * @ORM\JoinColumn(name="programa_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $programa;

    /**
     * 
     * @ORM\ManyToOne(targetEntity="PlanillaTipo", inversedBy="planilla", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="tipo_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $planillatipo;
    
    /**
     * @ORM\OneToMany(targetEntity="CostosLogistica", mappedBy="planilla", cascade={"persist"})
     * 
     */
    protected $costosLogistica;

    /**
     * @ORM\OneToMany(targetEntity="Incentives\InventarioBundle\Entity\Inventario", mappedBy="planilla", cascade={"persist"})
     * 
     */
    protected $inventario;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Pais", inversedBy="planilla")
     * @ORM\JoinColumn(name="pais_id", referencedColumnName="id", nullable=true)
     */
    protected $pais;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Incentives\OperacionesBundle\Entity\Categoria", inversedBy="planilla")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=true)
     */
    protected $categoria;

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
     * 
     * @ORM\ManyToOne(targetEntity="Incentives\SolicitudesBundle\Entity\Solicitud", inversedBy="planilla")
     * @ORM\JoinColumn(name="solicitud_id", referencedColumnName="id", nullable=true)
     * 
     */
    protected $solicitud;


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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Planilla
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
     * Set consecutivo
     *
     * @param string $consecutivo
     * @return Planilla
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
     * Set ruta
     *
     * @param string $ruta
     * @return Planilla
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    
        return $this;
    }

    /**
     * Get ruta
     *
     * @return string 
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set planillaEstado
     *
     * @param \Incentives\InventarioBundle\Entity\PlanillaEstado $planillaEstado
     * @return Planilla
     */
    public function setPlanillaEstado(\Incentives\InventarioBundle\Entity\PlanillaEstado $planillaEstado = null)
    {
        $this->planillaEstado = $planillaEstado;
    
        return $this;
    }

    /**
     * Get planillaEstado
     *
     * @return \Incentives\InventarioBundle\Entity\PlanillaEstado 
     */
    public function getPlanillaEstado()
    {
        return $this->planillaEstado;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->inventario = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add inventario
     *
     * @param \Incentives\InventarioBundle\Entity\Inventario $inventario
     * @return Planilla
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
     * Set pais
     *
     * @param \Incentives\OperacionesBundle\Entity\Pais $pais
     * @return Planilla
     */
    public function setPais(\Incentives\OperacionesBundle\Entity\Pais $pais = null)
    {
        $this->pais = $pais;
    
        return $this;
    }

    /**
     * Get pais
     *
     * @return \Incentives\OperacionesBundle\Entity\Pais 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set categoria
     *
     * @param \Incentives\OperacionesBundle\Entity\Categoria $categoria
     * @return Planilla
     */
    public function setCategoria(\Incentives\OperacionesBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Incentives\OperacionesBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set planillatipo
     *
     * @param \Incentives\InventarioBundle\Entity\PlanillaTipo $planillatipo
     * @return Planilla
     */
    public function setPlanillatipo(\Incentives\InventarioBundle\Entity\PlanillaTipo $planillatipo = null)
    {
        $this->planillatipo = $planillatipo;
    
        return $this;
    }

    /**
     * Get planillatipo
     *
     * @return \Incentives\InventarioBundle\Entity\PlanillaTipo 
     */
    public function getPlanillatipo()
    {
        return $this->planillatipo;
    }

    /**
     * Add costosLogistica
     *
     * @param \Incentives\InventarioBundle\Entity\CostosLogistica $costosLogistica
     * @return Planilla
     */
    public function addCostosLogistica(\Incentives\InventarioBundle\Entity\CostosLogistica $costosLogistica)
    {
        $this->costosLogistica[] = $costosLogistica;
    
        return $this;
    }

    /**
     * Remove costosLogistica
     *
     * @param \Incentives\InventarioBundle\Entity\CostosLogistica $costosLogistica
     */
    public function removeCostosLogistica(\Incentives\InventarioBundle\Entity\CostosLogistica $costosLogistica)
    {
        $this->costosLogistica->removeElement($costosLogistica);
    }

    /**
     * Get costosLogistica
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCostosLogistica()
    {
        return $this->costosLogistica;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Planilla
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
     * @return Planilla
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
     * Set solicitud
     *
     * @param \Incentives\SolicitudesBundle\Entity\Solicitud $solicitud
     * @return Planilla
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
     * Set programa
     *
     * @param \Incentives\CatalogoBundle\Entity\Programa $programa
     * @return Planilla
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
}